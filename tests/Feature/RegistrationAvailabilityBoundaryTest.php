<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('registration-boundaries')]
class RegistrationAvailabilityBoundaryTest extends TestCase
{
    use DatabaseTransactions;

    protected function tearDown(): void
    {
        $this->travelBack();
        parent::tearDown();
    }

    public static function windows(): array
    {
        return [
            'before opening day' => ['2026-11-17 23:59:59', false],
            'opening day midnight' => ['2026-11-18 00:00:00', true],
            'opening day midday' => ['2026-11-18 12:00:00', true],
            'closing day midnight' => ['2026-11-20 00:00:00', true],
            'closing day last second' => ['2026-11-20 23:59:59', true],
            'after closing midnight' => ['2026-11-21 00:00:00', false],
        ];
    }

    #[DataProvider('windows')]
    public function test_registration_dates_are_inclusive_and_commercial_checkout_stays_blocked(string $time, bool $open): void
    {
        $user = $this->fixture($time);
        $this->getJson($this->api())->assertOk()->assertJsonPath('data.registration_open', $open);
        $this->actingAs($user)->get($this->step())->assertStatus($open ? 200 : 409);
        $this->get($this->checkout())->assertStatus(409);
        $this->assertNoPurchaseSideEffects();
    }

    public static function visibility(): array
    {
        return [
            'private registration' => [false, 2, false, false],
            'draft' => [true, 0, false, false],
            'pre-registration' => [true, 1, true, false],
            'registration' => [true, 2, true, true],
            'start soon' => [true, 3, true, false],
            'ongoing' => [true, 4, true, false],
            'completed' => [true, 5, true, false],
            'sold out' => [true, 6, true, false],
            'canceled' => [true, 7, false, false],
        ];
    }

    #[DataProvider('visibility')]
    public function test_visibility_and_registration_are_distinct(bool $public, int $status, bool $visible, bool $open): void
    {
        $user = $this->fixture();
        DB::table('groups')->where('id', $this->group)->update(['public' => $public, 'status' => $status]);
        $response = $this->getJson($this->api())->assertStatus($visible ? 200 : 404);
        if ($visible) $response->assertJsonPath('data.registration_open', $open);
        $this->actingAs($user)->get($this->step())->assertStatus($visible ? ($open ? 200 : 409) : 404);
        $this->get($this->checkout())->assertStatus($visible ? 409 : 404);
        $this->assertNoPurchaseSideEffects();
    }

    public static function capacities(): array
    {
        return [
            'empty' => [2, 0, 2, true],
            'one seat left' => [2, 1, 1, true],
            'exactly full' => [2, 2, 0, false],
            'over capacity preserves raw response' => [2, 3, -1, false],
            'zero capacity' => [0, 0, 0, false],
        ];
    }

    #[DataProvider('capacities')]
    public function test_current_capacity_boundaries_are_preserved(int $maximum, int $used, int $remaining, bool $open): void
    {
        $user = $this->fixture();
        DB::table('groups')->where('id', $this->group)->update(['max_capacity' => $maximum]);
        for ($i = 0; $i < $used; $i++) $this->participant($i, 0);
        $this->getJson($this->api())->assertOk()->assertJsonPath('data.capacity', $remaining)->assertJsonPath('data.registration_open', $open);
        $this->actingAs($user)->get($this->step())->assertStatus($open ? 200 : 409);
        $this->get($this->checkout())->assertStatus(409);
        $this->assertNoPurchaseSideEffects();
    }

    public static function participantStatuses(): array
    {
        return ['booked' => [0], 'pending' => [1], 'rejected' => [2], 'canceled' => [3], 'completed' => [4], 'reservation' => [5]];
    }

    #[DataProvider('participantStatuses')]
    public function test_existing_all_status_count_is_characterized_without_approving_a_new_seat_rule(int $status): void
    {
        $user = $this->fixture();
        DB::table('groups')->where('id', $this->group)->update(['max_capacity' => 1]);
        $this->participant(0, $status);
        $this->getJson($this->api())->assertOk()->assertJsonPath('data.capacity', 0)->assertJsonPath('data.registration_open', false);
        $this->actingAs($user)->get($this->step())->assertStatus(409);
        $this->get($this->checkout())->assertStatus(409);
        $this->assertNoPurchaseSideEffects();
    }

    public function test_guest_and_verified_entry_points_keep_their_current_authorization_contract(): void
    {
        $user = $this->fixture();
        $this->getJson($this->api())->assertOk(); // Public availability read is intentional.
        $this->get($this->step())->assertRedirect('/login');
        $this->get($this->checkout())->assertRedirect('/login');
        $user->forceFill(['email_verified_at' => null])->save();
        $this->actingAs($user)->get($this->checkout())->assertRedirect(route('verification.notice'));
        $user->forceFill(['email_verified_at' => now()])->save();
        $this->get($this->step())->assertOk();
        $this->get($this->checkout())->assertStatus(409);
        $this->assertNoPurchaseSideEffects();
    }

    public function test_stored_price_items_keep_amount_currency_and_response_shape_without_a_payable_total(): void
    {
        $this->fixture();
        $currency = DB::table('currencies')->insertGetId(['name' => 'CAD', 'symbol' => 'C$', 'flag' => 'fixture']);
        $item = DB::table('group_price_items')->insertGetId(['group_id' => $this->group, 'currency_id' => $currency,
            'title' => 'Synthetic stored fare', 'amount' => 42.35, 'created_at' => now(), 'updated_at' => now()]);
        $response = $this->getJson($this->api())->assertOk()->assertJsonPath('data.price_items.0.id', $item)
            ->assertJsonPath('data.price_items.0.title', 'Synthetic stored fare')->assertJsonPath('data.price_items.0.currency', 'CAD')
            ->assertJsonPath('data.price_items.0.symbol', 'C$')->assertJsonMissingPath('data.total')->assertJsonMissingPath('data.invoice');
        $this->assertSame('42.35', (string) $response->json('data.price_items.0.amount'));
        $this->assertNoPurchaseSideEffects();
    }

    public function test_group_from_another_tour_cannot_be_used_at_the_entry_points(): void
    {
        $user = $this->fixture();
        DB::table('groups')->where('id', $this->group)->update(['tour_id' => (string) Str::ulid()]);
        $this->getJson($this->api())->assertNotFound();
        $this->actingAs($user)->get($this->step())->assertNotFound();
        $this->get($this->checkout())->assertNotFound();
        $this->assertNoPurchaseSideEffects();
    }

    private string $group;

    private function fixture(string $time = '2026-11-19 12:00:00'): User
    {
        $this->travelTo(Carbon::parse($time, config('app.timezone')));
        Event::fake();
        $language = Language::firstOrCreate(['slug' => 'en'], ['title' => 'English', 'preferred_currencies' => []]);
        $user = $this->user('reader');
        $region = DB::table('regions')->insertGetId(['name' => 'Boundary region', 'slug' => 'boundary-region']);
        $country = DB::table('countries')->insertGetId(['name' => 'Boundary country', 'slug' => 'boundary-country',
            'code' => 'XB', 'phone' => '+000', 'region_id' => $region]);
        $city = DB::table('cities')->insertGetId(['name' => 'Boundary city', 'slug' => 'boundary-city',
            'country_id' => $country, 'latitude' => '0', 'longitude' => '0']);
        $tour = (string) Str::ulid();
        DB::table('tours')->insert(['id' => $tour, 'user_id' => $user->id, 'certification_id' => (string) Str::ulid(),
            'teacher_name' => 'Synthetic', 'language_id' => $language->id, 'title' => 'Boundary tour', 'slug' => 'boundary-tour',
            'short_summary' => 'Synthetic', 'city_id' => $city, 'tour_overview' => 'Synthetic', 'status' => 2]);
        $this->group = (string) Str::ulid();
        DB::table('groups')->insert(['id' => $this->group, 'tour_id' => $tour, 'language_id' => $language->id,
            'title' => 'Boundary group', 'slug' => 'boundary-group', 'public' => true,
            'start_registration_date' => '2026-11-18', 'end_registration_date' => '2026-11-20',
            'start_date_tour' => '2026-12-01', 'end_date_tour' => '2026-12-04',
            'days' => 3, 'nights' => 2, 'min_capacity' => 1, 'max_capacity' => 2, 'status' => 2,
            'created_at' => now(), 'updated_at' => now()]);
        return $user;
    }

    private function user(string $name): User
    {
        return User::create(['fname' => 'Synthetic', 'lname' => $name, 'slug' => 'boundary-'.$name,
            'email' => 'boundary-'.$name.'@example.test', 'password' => 'unused', 'sex' => 1, 'email_verified_at' => now()]);
    }

    private function participant(int $index, int $status): void
    {
        $user = $this->user('participant-'.$index);
        DB::table('group_users')->insert(['group_id' => $this->group, 'user_id' => $user->id, 'status' => $status,
            'created_at' => now(), 'updated_at' => now()]);
    }

    private function api(): string { return '/api/booking/tour/boundary-tour/group/boundary-group'; }
    private function step(): string { return '/tour/boundary-tour/group/boundary-group/step1'; }
    private function checkout(): string { return '/tour/boundary-tour/tour-operation/'.$this->group.'/booking'; }

    private function assertNoPurchaseSideEffects(): void
    {
        $this->assertDatabaseCount('invoices', 0);
        $this->assertDatabaseCount('transactions', 0);
    }
}
