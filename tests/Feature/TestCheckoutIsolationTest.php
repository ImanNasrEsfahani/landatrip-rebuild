<?php

namespace Tests\Feature;

use App\Services\TestCheckout;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Shetabit\Payment\Facade\Payment;
use Tests\TestCase;

class TestCheckoutIsolationTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        if (! app(TestCheckout::class)->available()) {
            $this->markTestSkipped('The disposable MySQL fixture is required.');
        }
    }

    public function test_fake_callback_cannot_change_a_commercial_invoice_even_with_a_fake_transaction_and_hold(): void
    {
        Payment::shouldReceive('amount')->never();
        $userId = DB::table('users')->where('email', 'e2e-user@example.invalid')->value('id');
        $groupId = DB::table('groups')->where('slug', 'e2e-sample-group')->value('id');
        $currencyId = DB::table('currencies')->where('name', 'CAD')->value('id');
        $id = (string) Str::ulid();
        $authority = 'fake_'.str_repeat('A', 32);
        DB::table('invoices')->insert([
            'id' => $id, 'title' => 'Commercial legacy invoice', 'user_id' => $userId,
            'currency_id' => $currencyId, 'subtotal' => 12.34, 'discount' => 0,
            'tax' => 0, 'total' => 12.34, 'expire' => now()->addDay()->toDateString(),
            'status' => 0, 'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('booking_holds')->insert([
            'invoice_id' => $id, 'group_id' => $groupId, 'quantity' => 1,
            'status' => 'active', 'expires_at' => now()->addMinute(),
            'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('transactions')->insert([
            'invoice_id' => $id, 'authority' => $authority, 'session_id' => 'legacy-session',
            'provider' => 'fake', 'gateway_minor_units' => 1234, 'status' => 0,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        $this->postJson('/api/__e2e/checkout/callback', [
            'authority' => $authority, 'result' => 'success',
        ])->assertNotFound();
        $this->assertSame(0, DB::table('invoices')->where('id', $id)->value('status'));
        $this->assertSame('active', DB::table('booking_holds')->where('invoice_id', $id)->value('status'));
        $this->assertSame(0, DB::table('transactions')->where('authority', $authority)->value('status'));
    }

    public function test_synthetic_callback_is_idempotent_without_a_real_provider_call(): void
    {
        Payment::shouldReceive('amount')->never();
        $checkout = app(TestCheckout::class);
        $userId = DB::table('users')->where('email', 'e2e-user@example.invalid')->value('id');
        $groupId = DB::table('groups')->where('slug', 'e2e-sample-group')->value('id');
        $invoice = $checkout->create($groupId, $userId, ['participants' => ['adult']], (string) Str::ulid());
        $authority = $checkout->initiate($invoice['id'], $userId)['authority'];
        $this->get('/payment/verify?Authority='.$authority.'&Status=OK')->assertNotFound();
        $this->assertSame(['status' => 1, 'duplicate' => false], $checkout->callback($authority, 'success'));
        $this->assertSame(['status' => 1, 'duplicate' => true], $checkout->callback($authority, 'failure'));
        $this->assertSame(1, DB::table('invoices')->where('id', $invoice['id'])->value('status'));
        $this->assertSame('booked', DB::table('booking_holds')->where('invoice_id', $invoice['id'])->value('status'));
        $this->assertSame(2, DB::table('transactions')->where('authority', $authority)->value('status'));
        $this->assertSame('42.35', DB::table('invoices')->where('id', $invoice['id'])->value('total_exact'));
    }

    public function test_terminal_invoice_cannot_be_reversed_by_a_stale_pending_transaction(): void
    {
        Payment::shouldReceive('amount')->never();
        $checkout = app(TestCheckout::class);
        $userId = DB::table('users')->where('email', 'e2e-user@example.invalid')->value('id');
        $groupId = DB::table('groups')->where('slug', 'e2e-sample-group')->value('id');
        $invoice = $checkout->create($groupId, $userId, ['participants' => ['adult']], (string) Str::ulid());
        $authority = $checkout->initiate($invoice['id'], $userId)['authority'];
        DB::table('invoices')->where('id', $invoice['id'])->update(['status' => 1]);
        DB::table('booking_holds')->where('invoice_id', $invoice['id'])->update(['status' => 'booked']);

        $this->assertSame(['status' => 1, 'duplicate' => true], $checkout->callback($authority, 'failure'));
        $this->assertSame(1, DB::table('invoices')->where('id', $invoice['id'])->value('status'));
        $this->assertSame('booked', DB::table('booking_holds')->where('invoice_id', $invoice['id'])->value('status'));
    }

    public function test_all_fixture_endpoints_reject_missing_flags_or_a_wrong_fixture_marker(): void
    {
        $user = User::where('email', 'e2e-user@example.invalid')->firstOrFail();
        $this->actingAs($user);
        $paths = [
            ['POST', '/api/__e2e/checkout/callback'],
            ['POST', '/api/__e2e/checkout/groups/invalid/quote'],
            ['POST', '/api/__e2e/checkout/groups/invalid/invoices'],
            ['GET', '/api/__e2e/checkout/invoices/invalid'],
            ['POST', '/api/__e2e/checkout/invoices/invalid/initiate'],
            ['POST', '/api/__e2e/checkout/invoices/invalid/expire-for-test'],
        ];
        $original = [
            'enabled' => config('booking_test.enabled'),
            'gateway' => config('booking_test.gateway'),
            'fixture_token' => config('booking_test.fixture_token'),
            'database' => config('database.connections.mysql.database'),
            'host' => config('database.connections.mysql.host'),
            'username' => config('database.connections.mysql.username'),
        ];
        foreach ([
            ['booking_test.enabled', false],
            ['booking_test.gateway', ''],
            ['booking_test.fixture_token', str_repeat('x', 64)],
            ['database.connections.mysql.database', 'landatrip_audit'],
            ['database.connections.mysql.host', 'another-mysql-host'],
            ['database.connections.mysql.username', 'commercial_user'],
        ] as [$key, $value]) {
            config()->set($key, $value);
            foreach ($paths as [$method, $path]) {
                $this->json($method, $path, [])->assertStatus(409);
            }
            config()->set('booking_test.enabled', $original['enabled']);
            config()->set('booking_test.gateway', $original['gateway']);
            config()->set('booking_test.fixture_token', $original['fixture_token']);
            config()->set('database.connections.mysql.database', $original['database']);
            config()->set('database.connections.mysql.host', $original['host']);
            config()->set('database.connections.mysql.username', $original['username']);
        }
    }
}
