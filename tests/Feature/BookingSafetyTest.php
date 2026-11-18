<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\TestCase;

class BookingSafetyTest extends TestCase
{
    use DatabaseTransactions;

    private function fixture(): array
    {
        Event::fake();
        $user = User::create([
            'fname' => 'Booking', 'lname' => 'Fixture',
            'slug' => 'booking-fixture-user',
            'email' => 'booking-fixture@example.invalid',
            'password' => 'unused', 'sex' => 1,
            'email_verified_at' => now(),
        ]);
        $tourId = (string) Str::ulid();
        DB::table('tours')->insert([
            'id' => $tourId, 'user_id' => $user->id,
            'certification_id' => (string) Str::ulid(),
            'teacher_name' => 'Fixture', 'language_id' => 1,
            'title' => 'Booking Fixture', 'slug' => 'booking-fixture',
            'short_summary' => 'Fixture', 'city_id' => 1,
            'tour_overview' => 'Fixture', 'status' => 2,
        ]);
        $groupId = (string) Str::ulid();
        DB::table('groups')->insert([
            'id' => $groupId, 'tour_id' => $tourId, 'language_id' => 1,
            'title' => 'Booking Group', 'slug' => 'booking-group',
            'start_registration_date' => now()->subDay()->toDateString(),
            'end_registration_date' => now()->addDay()->toDateString(),
            'start_date_tour' => now()->addMonth()->toDateString(),
            'end_date_tour' => now()->addMonth()->addDays(3)->toDateString(),
            'days' => 3, 'nights' => 2, 'min_capacity' => 1,
            'max_capacity' => 1, 'status' => 2,
            'created_at' => now(), 'updated_at' => now(),
        ]);
        return [$user, $tourId, $groupId];
    }

    public function test_booking_requires_login_and_never_creates_an_unpriced_invoice(): void
    {
        [$user, , $groupId] = $this->fixture();
        $url = "/tour/booking-fixture/tour-operation/{$groupId}/booking";
        $this->get($url)->assertRedirect('/login');
        $this->actingAs($user)->get($url)->assertStatus(409);
        $this->assertDatabaseCount('invoices', 0);
        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_booking_rejects_a_group_from_another_tour_and_closed_registration(): void
    {
        [$user, $tourId, $groupId] = $this->fixture();
        $this->actingAs($user);
        $this->get("/tour/missing-tour/tour-operation/{$groupId}/booking")->assertNotFound();
        DB::table('groups')->where('id', $groupId)->update(['tour_id' => (string) Str::ulid()]);
        $this->get("/tour/booking-fixture/tour-operation/{$groupId}/booking")->assertNotFound();
        DB::table('groups')->where('id', $groupId)->update([
            'tour_id' => $tourId, 'end_registration_date' => now()->subDay()->toDateString(),
        ]);
        $this->get("/tour/booking-fixture/tour-operation/{$groupId}/booking")->assertStatus(409);
    }

    public function test_booking_rejects_a_full_group(): void
    {
        [$user, , $groupId] = $this->fixture();
        DB::table('group_users')->insert([
            'group_id' => $groupId, 'user_id' => $user->id,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        $this->actingAs($user)
            ->get("/tour/booking-fixture/tour-operation/{$groupId}/booking")
            ->assertStatus(409);
        $this->get('/tour/booking-fixture/group/booking-group/step1')->assertStatus(409);
        $this->assertDatabaseCount('transactions', 0);
    }
}
