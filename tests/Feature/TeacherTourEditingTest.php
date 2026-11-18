<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\Role;
use App\Models\TourItinerary;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class TeacherTourEditingTest extends TestCase
{
    use DatabaseTransactions;

    public function test_only_the_owner_can_read_edit_data_or_submit_updates(): void
    {
        [$owner, $tour, $days] = $this->fixture();
        $uri = $this->uri($tour);
        $this->getJson($uri.'/edit-data')->assertUnauthorized();
        $this->putJson($uri, ['title' => 'Denied title'])->assertUnauthorized();
        $other = $this->user('other');
        $this->actingAs($other)->getJson($uri.'/edit-data')->assertForbidden();
        $this->putJson($uri, ['title' => 'Denied title'])->assertForbidden();
        $this->assertDatabaseHas('tours', ['id' => $tour, 'title' => 'Original tour']);
        $this->actingAs($owner)->getJson($uri.'/edit-data')->assertOk()->assertJsonPath('data.title', 'Original tour');
        $this->getJson($uri)->assertOk(); // Existing teacher list links use the tour ID.
    }

    public function test_partial_update_preserves_omitted_metadata_certificates_days_and_media(): void
    {
        [$owner, $tour, $days, $template, $city, $language] = $this->fixture();
        Storage::fake('public');
        Storage::disk('public')->put('existing-media.txt', 'Synthetic preserved media');
        $this->actingAs($owner)->putJson($this->uri($tour), ['title' => 'Updated title', 'user_id' => 'forged', 'status' => 2])->assertOk()->assertContent('1');
        $this->assertDatabaseHas('tours', ['id' => $tour, 'title' => 'Updated title', 'user_id' => $owner->id,
            'city_id' => $city, 'language_id' => $language, 'certification_id' => $template, 'days' => 3, 'status' => 1]);
        $this->assertSame(2, DB::table('tour_itineraries')->where('tour_id', $tour)->count());
        $this->assertDatabaseHas('images', ['parentable_id' => $tour, 'url' => 'existing-media.txt']);
        Storage::disk('public')->assertExists('existing-media.txt');
        $this->putJson($this->uri($tour), [])->assertOk()->assertContent('1');
    }

    public function test_multiple_day_updates_and_appends_keep_omitted_rows_and_related_items(): void
    {
        [$owner, $tour, $days] = $this->fixture();
        $this->actingAs($owner)->putJson($this->uri($tour), ['itineraries' => [
            ['id' => $days[0], 'title' => 'Revised arrival'],
            ['id' => $days[1], 'description' => 'Revised exploration'],
            ['title' => 'Final days', 'description' => 'Synthetic finale', 'start' => 4, 'end' => 5],
        ], 'includes' => [['title' => 'New included item']]])->assertOk()->assertContent('1');
        $this->assertSame(3, DB::table('tour_itineraries')->where('tour_id', $tour)->count());
        $this->assertDatabaseHas('tour_itineraries', ['id' => $days[0], 'title' => 'Revised arrival', 'start' => '1', 'end' => '1']);
        $this->assertDatabaseHas('tour_itineraries', ['id' => $days[1], 'description' => 'Revised exploration']);
        $this->assertDatabaseHas('tours', ['id' => $tour, 'days' => 5, 'nights' => 4]);
        $this->assertDatabaseHas('tour_includes', ['tour_id' => $tour, 'title' => 'Original included item']);
        $this->assertDatabaseHas('tour_includes', ['tour_id' => $tour, 'title' => 'New included item']);
        $this->putJson($this->uri($tour), ['itineraries' => [['id' => $days[0], 'description' => 'One changed day']]])->assertOk();
        $this->assertSame(3, DB::table('tour_itineraries')->where('tour_id', $tour)->count());
    }

    public function test_invalid_cross_tour_duplicate_and_incomplete_days_cause_no_writes(): void
    {
        [$owner, $tour, $days] = $this->fixture();
        $foreign = DB::table('tour_itineraries')->insertGetId(['tour_id' => (string) Str::ulid(), 'title' => 'Foreign day', 'description' => 'Synthetic', 'start' => 1, 'end' => 1]);
        foreach ([
            [['id' => $foreign, 'title' => 'Denied day']],
            [['id' => $days[0], 'start' => 4]],
            [['id' => $days[0], 'title' => 'First value'], ['id' => $days[0], 'title' => 'Second value']],
            [['title' => 'Incomplete day', 'start' => 4, 'end' => 5]],
        ] as $items) {
            $this->actingAs($owner)->putJson($this->uri($tour), ['title' => 'Must not save', 'itineraries' => $items])->assertUnprocessable();
            $this->assertDatabaseHas('tours', ['id' => $tour, 'title' => 'Original tour']);
        }
        $this->assertDatabaseHas('tour_itineraries', ['id' => $foreign, 'title' => 'Foreign day']);
    }

    public function test_later_append_failure_rolls_back_parent_and_earlier_day_updates(): void
    {
        [$owner, $tour, $days] = $this->fixture();
        $reached = false;
        Event::listen('eloquent.creating: '.TourItinerary::class, function ($row) use (&$reached) {
            if ($row->title === 'Failure day') { $reached = true; throw new \RuntimeException('Synthetic editing failure'); }
        });
        $this->actingAs($owner)->putJson($this->uri($tour), ['title' => 'Rolled back title', 'itineraries' => [
            ['id' => $days[0], 'title' => 'Rolled back day'],
            ['title' => 'Failure day', 'description' => 'Synthetic failure', 'start' => 4, 'end' => 4],
        ]])->assertStatus(500);
        $this->assertTrue($reached);
        $this->assertDatabaseHas('tours', ['id' => $tour, 'title' => 'Original tour']);
        $this->assertDatabaseHas('tour_itineraries', ['id' => $days[0], 'title' => 'Arrival day']);
        $this->assertSame(2, DB::table('tour_itineraries')->where('tour_id', $tour)->count());
    }

    public function test_explicit_language_and_location_update_while_certificate_selection_fails_closed(): void
    {
        [$owner, $tour, $days, $template, $city] = $this->fixture();
        $language = Language::firstOrCreate(['slug' => 'fr'], ['title' => 'French', 'preferred_currencies' => []]);
        $this->actingAs($owner)->putJson($this->uri($tour), ['language_id' => $language->id, 'location_id' => $city])->assertOk();
        $this->assertDatabaseHas('tours', ['id' => $tour, 'language_id' => $language->id, 'certification_id' => $template]);
        $this->putJson($this->uri($tour), ['certification_id' => $template])->assertUnprocessable();
        $this->putJson($this->uri($tour), ['certification_id' => null])->assertUnprocessable();
        $this->assertDatabaseHas('tours', ['id' => $tour, 'certification_id' => $template]);
    }

    private function fixture(): array
    {
        $language = Language::firstOrCreate(['slug' => 'en'], ['title' => 'English', 'preferred_currencies' => []]);
        $owner = $this->user('owner');
        $region = DB::table('regions')->insertGetId(['name' => 'Edit region', 'slug' => 'edit-region']);
        $country = DB::table('countries')->insertGetId(['name' => 'Edit country', 'slug' => 'edit-country', 'code' => 'XE', 'phone' => '+000', 'region_id' => $region]);
        $city = DB::table('cities')->insertGetId(['name' => 'Edit city', 'slug' => 'edit-city', 'country_id' => $country, 'latitude' => '0', 'longitude' => '0']);
        $template = (string) Str::ulid();
        DB::table('certificate_templates')->insert(['id' => $template, 'name' => 'Existing template', 'url' => 'synthetic-template', 'created_at' => now(), 'updated_at' => now()]);
        $tour = (string) Str::ulid();
        DB::table('tours')->insert(['id' => $tour, 'user_id' => $owner->id, 'certification_id' => $template,
            'teacher_name' => $owner->name, 'language_id' => $language->id, 'title' => 'Original tour', 'slug' => 'editing-tour',
            'short_summary' => 'Original summary', 'tour_overview' => 'Original overview', 'city_id' => $city, 'days' => 3, 'nights' => 2]);
        $days = [];
        foreach ([['Arrival day', 1, 1], ['Explore region', 2, 3]] as [$title, $start, $end]) $days[] = DB::table('tour_itineraries')->insertGetId(['tour_id' => $tour, 'title' => $title, 'description' => 'Original description', 'start' => $start, 'end' => $end]);
        DB::table('tour_includes')->insert(['tour_id' => $tour, 'title' => 'Original included item']);
        DB::table('images')->insert(['parentable_id' => $tour, 'parentable_type' => \App\Models\Tour::class, 'url' => 'existing-media.txt', 'image_type' => 'header', 'alt' => 'Synthetic preserved']);
        return [$owner, $tour, $days, $template, $city, $language->id];
    }

    private function user(string $name): User
    {
        $user = User::withoutEvents(fn () => User::create(['fname' => 'Synthetic', 'lname' => $name, 'slug' => 'edit-tour-'.$name,
            'email' => 'edit-tour-'.$name.'@example.test', 'password' => 'unused', 'sex' => 1]));
        $user->addRole(Role::firstOrCreate(['name' => 'teacher'], ['display_name' => 'Teacher']));
        return $user;
    }

    private function uri(string $id): string { return '/api/web/v1/teacher-panel/tours/'.$id; }
}
