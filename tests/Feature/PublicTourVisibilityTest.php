<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\TestCase;

class PublicTourVisibilityTest extends TestCase
{
    use DatabaseTransactions;

    public function test_unpublished_tours_are_hidden_from_public_detail_cards_and_booking_api(): void
    {
        [$tour, $group] = $this->fixture();
        DB::table('tours')->where('id', $tour)->update(['status' => 0]);
        $this->get('/tour/visibility-tour')->assertNotFound();
        $this->getJson('/api/card/tour/visibility-tour')->assertNotFound();
        $this->getJson('/api/booking/tour/visibility-tour/group/visible-group')->assertNotFound();
    }

    public function test_public_cards_omit_private_draft_canceled_and_wrong_language_groups(): void
    {
        [$tour, $group] = $this->fixture();
        $language = Language::firstOrCreate(['slug' => 'fr'], ['title' => 'French', 'preferred_currencies' => []]);
        foreach (['private', 'draft', 'canceled', 'foreign'] as $kind) {
            $row = (array) DB::table('groups')->where('id', $group)->first();
            $row['id'] = (string) Str::ulid();
            $row['slug'] = 'hidden-'.$kind;
            $row['public'] = $kind === 'private' ? false : true;
            $row['status'] = match ($kind) { 'draft' => 0, 'canceled' => 7, default => 2 };
            $row['language_id'] = $kind === 'foreign' ? $language->id : $row['language_id'];
            DB::table('groups')->insert($row);
            $this->getJson('/api/booking/tour/visibility-tour/group/'.$row['slug'])->assertNotFound();
        }
        $this->getJson('/api/card/tour/visibility-tour')->assertOk()->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.slug', 'visible-group');
        $this->get('/tour?q=Visibility')->assertOk()->assertViewHas('listing',
            fn ($listing) => $listing['items']->first()['groups'] === 1);
        $this->getJson('/api/booking/tour/visibility-tour/group/visible-group')->assertOk();
    }

    public function test_tour_with_no_public_group_returns_404_instead_of_using_a_private_group(): void
    {
        [$tour, $group] = $this->fixture();
        DB::table('groups')->where('id', $group)->update(['public' => false]);
        $this->get('/tour/visibility-tour')->assertNotFound();
        $this->getJson('/api/card/tour/visibility-tour')->assertOk()->assertJsonCount(0, 'data');
    }

    private function fixture(): array
    {
        Event::fake();
        $language = Language::firstOrCreate(['slug' => 'en'], ['title' => 'English', 'preferred_currencies' => []]);
        $user = User::create(['fname' => 'Synthetic', 'lname' => 'Visibility', 'slug' => 'visibility-teacher',
            'email' => 'visibility-teacher@example.test', 'password' => 'unused', 'sex' => 1]);
        $region = DB::table('regions')->insertGetId(['name' => 'Visibility region', 'slug' => 'visibility-region']);
        $country = DB::table('countries')->insertGetId(['name' => 'Visibility country', 'slug' => 'visibility-country',
            'code' => 'XV', 'phone' => '+000', 'region_id' => $region]);
        $city = DB::table('cities')->insertGetId(['name' => 'Visibility city', 'slug' => 'visibility-city',
            'country_id' => $country, 'latitude' => '0', 'longitude' => '0']);
        $tour = (string) Str::ulid();
        DB::table('tours')->insert(['id' => $tour, 'user_id' => $user->id, 'certification_id' => (string) Str::ulid(),
            'teacher_name' => 'Synthetic', 'language_id' => $language->id, 'title' => 'Visibility Tour',
            'slug' => 'visibility-tour', 'short_summary' => 'Synthetic', 'city_id' => $city,
            'tour_overview' => 'Synthetic', 'status' => 2]);
        $group = (string) Str::ulid();
        DB::table('groups')->insert(['id' => $group, 'tour_id' => $tour, 'language_id' => $language->id,
            'title' => 'Visible Group', 'slug' => 'visible-group', 'public' => true,
            'start_registration_date' => now()->subDay()->toDateString(), 'end_registration_date' => now()->addDay()->toDateString(),
            'start_date_tour' => now()->addMonth()->toDateString(), 'end_date_tour' => now()->addMonth()->addDays(3)->toDateString(),
            'days' => 3, 'nights' => 2, 'min_capacity' => 1, 'max_capacity' => 10, 'status' => 2,
            'created_at' => now(), 'updated_at' => now()]);
        return [$tour, $group];
    }
}
