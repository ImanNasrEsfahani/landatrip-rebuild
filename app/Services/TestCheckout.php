<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/** Isolated synthetic contract. Every public method rejects non-disposable environments. */
class TestCheckout
{
    public function guard(): void
    {
        abort_unless(config('booking_test.enabled') === true
            && config('booking_test.gateway') === 'fake'
            && app()->environment(['local', 'testing'])
            && config('database.default') === 'mysql'
            && config('database.connections.mysql.database') === 'landatrip_e2e'
            && config('booking_test.hold_minutes') > 0, 409, 'Test checkout is unavailable.');
    }

    private function minor(string $amount): int
    {
        abort_unless(preg_match('/^(0|[1-9][0-9]*)\.[0-9]{2}$/', $amount) === 1, 409, 'Invalid stored money amount.');
        [$whole, $fraction] = explode('.', $amount);
        abort_unless(strlen($whole) <= 10, 409, 'Stored money amount is too large.');
        return (int) $whole * 100 + (int) $fraction;
    }

    private function money(int $minor): string
    {
        return sprintf('%d.%02d', intdiv($minor, 100), $minor % 100);
    }

    private function price(string $groupId, array $selection): array
    {
        $participants = $selection['participants'] ?? [];
        abort_unless(is_array($participants) && count($participants) > 0 && count($participants) <= 100, 422, 'Participants are required.');
        foreach ($participants as $category) {
            abort_unless($category === 'adult', 422, 'Unsupported participant category.');
        }
        $extras = $selection['extras'] ?? [];
        abort_unless(is_array($extras), 422, 'Invalid extras.');
        $items = DB::table('group_price_items')->where('group_id', $groupId)->get();
        $version = config('booking_test.pricing_version');
        $base = $items->where('pricing_version', $version)->where('pricing_role', 'mandatory')
            ->where('participant_category', 'adult');
        abort_unless($base->count() === 1, 409, 'Required price item is unconfigured.');
        $base = $base->first();
        $currency = DB::table('currencies')->where('id', $base->currency_id)->value('name');
        abort_unless($currency === 'CAD', 409, 'Synthetic currency is unconfigured.');
        $lines = [[
            'item_id' => $base->id, 'title' => $base->title, 'category' => 'adult',
            'quantity' => count($participants), 'unit_minor' => $this->minor((string) $base->amount),
        ]];
        $seen = [];
        foreach ($extras as $extra) {
            abort_unless(is_array($extra) && isset($extra['id'], $extra['quantity'])
                && is_int($extra['id']) && is_int($extra['quantity'])
                && $extra['quantity'] >= 1 && $extra['quantity'] <= count($participants)
                && ! isset($seen[$extra['id']]), 422, 'Invalid extra selection.');
            $seen[$extra['id']] = true;
            $item = $items->firstWhere('id', $extra['id']);
            abort_unless($item && $item->pricing_version === $version && $item->pricing_role === 'optional', 422, 'Invalid extra selection.');
            abort_unless($item->participant_category === 'adult', 422, 'Unsupported extra category.');
            abort_unless($item->currency_id === $base->currency_id, 409, 'Mixed currencies are unavailable.');
            $lines[] = [
                'item_id' => $item->id, 'title' => $item->title, 'category' => 'adult',
                'quantity' => $extra['quantity'], 'unit_minor' => $this->minor((string) $item->amount),
            ];
        }
        $subtotal = array_sum(array_map(fn ($line) => $line['quantity'] * $line['unit_minor'], $lines));
        abort_unless($subtotal > 0 && $subtotal <= 999999999999, 409, 'Invalid quoted amount.');
        $discount = config('booking_test.discount_minor_units');
        $tax = intdiv(($subtotal - $discount) * config('booking_test.tax_basis_points') + 5000, 10000);
        $total = $subtotal - $discount + $tax;
        return [
            'version' => $version, 'currency' => $currency, 'currency_id' => $base->currency_id,
            'participants' => count($participants), 'lines' => array_map(fn ($line) => $line + [
                'unit_amount' => $this->money($line['unit_minor']),
                'line_total' => $this->money($line['unit_minor'] * $line['quantity']),
            ], $lines),
            'subtotal' => $this->money($subtotal), 'discount' => $this->money($discount),
            'tax' => $this->money($tax), 'total' => $this->money($total),
            'gateway_minor_units' => $total,
        ];
    }

    public function quote(string $groupId, array $selection): array
    {
        $this->guard();
        $group = DB::table('groups')->where('id', $groupId)->first();
        abort_unless($group, 404);
        $this->assertOpen($group);
        return $this->price($groupId, $selection);
    }

    private function assertOpen(object $group): void
    {
        abort_unless($group->public && $group->status === 2
            && now()->toDateString() >= $group->start_registration_date
            && now()->toDateString() <= $group->end_registration_date, 409, 'Registration is closed.');
    }

    private function expireGroup(string $groupId): void
    {
        $expired = DB::table('booking_holds')->where('group_id', $groupId)
            ->where('status', 'active')->where('expires_at', '<=', now())->get();
        foreach ($expired as $hold) {
            DB::table('booking_holds')->where('id', $hold->id)->update(['status' => 'expired', 'updated_at' => now()]);
            DB::table('invoices')->where('id', $hold->invoice_id)->where('status', 0)
                ->update(['status' => 3, 'updated_at' => now()]);
            DB::table('transactions')->where('invoice_id', $hold->invoice_id)->where('status', 0)
                ->update(['status' => 1, 'updated_at' => now()]);
        }
    }

    public function create(string $groupId, string $userId, array $selection, string $key): array
    {
        $this->guard();
        return DB::transaction(function () use ($groupId, $userId, $selection, $key) {
            $group = DB::table('groups')->where('id', $groupId)->lockForUpdate()->first();
            abort_unless($group, 404);
            $this->assertOpen($group);
            $this->expireGroup($groupId);
            $quote = $this->price($groupId, $selection);
            $fingerprint = hash('sha256', json_encode([$groupId, $userId, $quote]));
            $existing = DB::table('invoices')->where('checkout_key', $key)->first();
            if ($existing) {
                abort_unless($existing->user_id === $userId && $existing->checkout_fingerprint === $fingerprint, 409, 'Checkout key was reused.');
                return $this->invoice($existing->id, $userId);
            }
            $held = (int) DB::table('booking_holds')->where('group_id', $groupId)
                ->whereIn('status', ['active', 'booked'])->sum('quantity');
            $legacyBooked = (int) DB::table('group_users')->where('group_id', $groupId)->whereIn('status', [0, 4, 5])->count();
            abort_unless($held + $legacyBooked + $quote['participants'] <= $group->max_capacity, 409, 'Group capacity is full.');
            $id = (string) Str::ulid();
            $expires = now()->addMinutes(config('booking_test.hold_minutes'));
            DB::table('invoices')->insert([
                'id' => $id, 'title' => 'Synthetic test booking', 'user_id' => $userId,
                'currency_id' => $quote['currency_id'], 'subtotal' => $quote['subtotal'],
                'discount' => $quote['discount'], 'tax' => $quote['tax'], 'total' => $quote['total'],
                'expire' => $expires->toDateString(), 'hold_expires_at' => $expires,
                'pricing_version' => $quote['version'], 'pricing_snapshot' => json_encode($quote),
                'checkout_key' => $key, 'checkout_fingerprint' => $fingerprint,
                'status' => 0, 'created_at' => now(), 'updated_at' => now(),
            ]);
            foreach ($quote['lines'] as $line) {
                DB::table('invoice_details')->insert([
                    'invoice_id' => $id, 'tour_id' => $group->tour_id, 'group_id' => $groupId,
                    'group_price_item_id' => $line['item_id'], 'title_snapshot' => $line['title'],
                    'participant_category' => $line['category'], 'currency_id' => $quote['currency_id'],
                    'count' => $line['quantity'], 'price' => $line['line_total'],
                    'unit_amount' => $line['unit_amount'], 'line_total' => $line['line_total'],
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }
            DB::table('booking_holds')->insert([
                'invoice_id' => $id, 'group_id' => $groupId, 'quantity' => $quote['participants'],
                'status' => 'active', 'expires_at' => $expires, 'created_at' => now(), 'updated_at' => now(),
            ]);
            return $this->invoice($id, $userId);
        }, 3);
    }

    public function invoice(string $id, string $userId): array
    {
        $this->guard();
        $invoice = DB::table('invoices')->where('id', $id)->where('user_id', $userId)->first();
        abort_unless($invoice, 404);
        $details = DB::table('invoice_details')->where('invoice_id', $id)->get();
        $hold = DB::table('booking_holds')->where('invoice_id', $id)->first();
        return [
            'id' => $id, 'group_id' => $hold?->group_id, 'status' => $invoice->status,
            'hold_status' => $hold?->status, 'hold_expires_at' => $hold?->expires_at,
            'pricing' => json_decode($invoice->pricing_snapshot ?? 'null', true),
            'details' => $details->map(fn ($detail) => [
                'group_id' => $detail->group_id, 'item_id' => $detail->group_price_item_id,
                'title' => $detail->title_snapshot, 'quantity' => $detail->count,
                'unit_amount' => $detail->unit_amount, 'line_total' => $detail->line_total,
            ])->all(),
        ];
    }

    public function initiate(string $id, string $userId): array
    {
        $this->guard();
        return DB::transaction(function () use ($id, $userId) {
            $invoice = DB::table('invoices')->where('id', $id)->where('user_id', $userId)->lockForUpdate()->first();
            abort_unless($invoice, 404);
            $hold = DB::table('booking_holds')->where('invoice_id', $id)->lockForUpdate()->first();
            abort_unless($invoice->status === 0 && $hold?->status === 'active' && $hold->expires_at > now(), 409, 'Invoice is no longer payable.');
            $transaction = DB::table('transactions')->where('invoice_id', $id)->where('provider', 'fake')->first();
            if (! $transaction) {
                $authority = 'fake_'.Str::random(32);
                DB::table('transactions')->insert([
                    'invoice_id' => $id, 'authority' => $authority, 'session_id' => 'test-only',
                    'provider' => 'fake', 'gateway_minor_units' => json_decode($invoice->pricing_snapshot, true)['gateway_minor_units'],
                    'status' => 0, 'created_at' => now(), 'updated_at' => now(),
                ]);
            } else {
                $authority = $transaction->authority;
            }
            return ['authority' => $authority, 'provider' => 'fake'];
        });
    }

    public function callback(string $authority, string $result): array
    {
        $this->guard();
        return DB::transaction(function () use ($authority, $result) {
            $transaction = DB::table('transactions')->where('authority', $authority)->where('provider', 'fake')->first();
            abort_unless($transaction, 404);
            $invoice = DB::table('invoices')->where('id', $transaction->invoice_id)->lockForUpdate()->first();
            $hold = DB::table('booking_holds')->where('invoice_id', $invoice->id)->lockForUpdate()->first();
            $transaction = DB::table('transactions')->where('id', $transaction->id)->lockForUpdate()->first();
            if ($transaction->status !== 0) {
                return ['status' => $invoice->status, 'duplicate' => true];
            }
            if ($hold->expires_at <= now() || $hold->status !== 'active') {
                DB::table('invoices')->where('id', $invoice->id)->update(['status' => 3]);
                DB::table('booking_holds')->where('id', $hold->id)->update(['status' => 'expired']);
                DB::table('transactions')->where('id', $transaction->id)->update(['status' => 1]);
                return ['status' => 3, 'duplicate' => false];
            }
            $success = $result === 'success';
            DB::table('invoices')->where('id', $invoice->id)->update(['status' => $success ? 1 : 2]);
            DB::table('booking_holds')->where('id', $hold->id)->update(['status' => $success ? 'booked' : 'released']);
            DB::table('transactions')->where('id', $transaction->id)->update(['status' => $success ? 2 : 1]);
            return ['status' => $success ? 1 : 2, 'duplicate' => false];
        });
    }

    public function expireForTest(string $id, string $userId): array
    {
        $this->guard();
        $invoice = DB::table('invoices')->where('id', $id)->where('user_id', $userId)->first();
        abort_unless($invoice, 404);
        DB::transaction(function () use ($id) {
            $hold = DB::table('booking_holds')->where('invoice_id', $id)->first();
            abort_unless($hold?->status === 'active', 409);
            DB::table('booking_holds')->where('id', $hold->id)->update(['expires_at' => now()->subSecond()]);
            $this->expireGroup($hold->group_id);
        });
        return $this->invoice($id, $userId);
    }
}
