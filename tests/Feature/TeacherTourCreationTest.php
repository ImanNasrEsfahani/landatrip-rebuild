<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\Role;
use App\Models\Tour;
use App\Models\TourItinerary;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\TestCase;

class TeacherTourCreationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_active_form_payload_creates_every_day_and_correct_child_types_for_the_teacher(): void
    {
        [$teacher, $payload] = $this->fixture();
        $payload['user_id'] = 'not-the-teacher';
        $payload['teacher_name'] = 'Untrusted name';
        $payload['status'] = 2;
        $this->actingAs($teacher)->postJson($this->uri(), $payload)->assertOk()->assertContent('1');
        $tour = Tour::where('title', $payload['title'])->firstOrFail();
        $this->assertSame($teacher->id, $tour->user_id);
        $this->assertSame($teacher->name, $tour->teacher_name);
        $this->assertSame((int) $payload['location_id'], (int) $tour->city_id);
        $this->assertSame(1, $tour->status->value);
        $this->assertNull($tour->certification_id);
        $this->assertNotEmpty($tour->slug);
        $this->assertSame(3, (int) $tour->days);
        $this->assertSame(2, (int) $tour->nights);
        $this->assertSame(['Arrival day', 'Explore region'], $tour->tourItineraries()->orderBy('start')->pluck('title')->all());
        $this->assertSame(['Included meals'], $tour->tourIncludes()->pluck('title')->all());
        $this->assertSame(['Excluded flights'], $tour->tourExcludes()->pluck('title')->all());
        $this->assertSame(['Scenic views'], $tour->tourHighlights()->pluck('title')->all());
    }

    public function test_configured_language_is_resolved_by_slug_instead_of_hardcoded_id_one(): void
    {
        [$teacher, $payload] = $this->fixture();
        $language = Language::firstOrCreate(['slug' => 'fr'], ['title' => 'French', 'preferred_currencies' => []]);
        app()->setLocale('fr');
        $this->actingAs($teacher)->postJson($this->uri(), $payload)->assertOk();
        $this->assertSame($language->id, Tour::where('title', $payload['title'])->firstOrFail()->language_id);
    }

    public function test_a_later_itinerary_failure_rolls_back_the_tour_and_all_earlier_children(): void
    {
        [$teacher, $payload] = $this->fixture();
        $reached = false;
        Event::listen('eloquent.creating: '.TourItinerary::class, function ($item) use (&$reached) {
            if ($item->title === 'Explore region') { $reached = true; throw new \RuntimeException('Synthetic itinerary failure'); }
        });
        $this->actingAs($teacher)->postJson($this->uri(), $payload)->assertStatus(500);
        $this->assertTrue($reached, 'Failure must occur after earlier itinerary persistence, not during tour creation.');
        $this->assertDatabaseMissing('tours', ['title' => $payload['title']]);
        $this->assertDatabaseMissing('tour_itineraries', ['title' => 'Arrival day']);
        $this->assertDatabaseMissing('tour_includes', ['title' => 'Included meals']);
        $this->assertDatabaseMissing('tour_excludes', ['title' => 'Excluded flights']);
        $this->assertDatabaseMissing('tour_highlights', ['title' => 'Scenic views']);
    }

    public function test_authentication_panel_role_and_required_fields_fail_before_writes(): void
    {
        [$teacher, $payload] = $this->fixture();
        $this->postJson($this->uri(), $payload)->assertUnauthorized();
        $other = $this->user('other', 'user');
        $this->actingAs($other)->postJson($this->uri(), $payload)->assertForbidden();
        foreach ([['location_id' => 99999999], ['age' => [40, 20]], ['itineraries' => []],
            ['itineraries' => [['title' => 'Bad day', 'description' => 'Bad range', 'start' => 3, 'end' => 1]]]] as $invalid) {
            $this->actingAs($teacher)->postJson($this->uri(), array_replace($payload, $invalid))->assertUnprocessable();
        }
        $this->assertDatabaseMissing('tours', ['title' => $payload['title']]);
    }

    public function test_existing_certificate_references_are_preserved_and_unverifiable_selection_is_rejected(): void
    {
        [$teacher, $payload] = $this->fixture();
        $template = (string) Str::ulid();
        DB::table('certificate_templates')->insert(['id' => $template, 'name' => 'Synthetic template', 'url' => 'synthetic-template', 'created_at' => now(), 'updated_at' => now()]);
        $legacy = (string) Str::ulid();
        DB::table('tours')->insert(['id' => $legacy, 'user_id' => $teacher->id, 'certification_id' => $template,
            'teacher_name' => $teacher->name, 'language_id' => Language::where('slug', 'en')->value('id'),
            'title' => 'Existing certificate tour', 'slug' => 'existing-certificate-tour', 'city_id' => $payload['location_id'],
            'short_summary' => 'Synthetic', 'tour_overview' => 'Synthetic']);
        $this->actingAs($teacher)->postJson($this->uri(), $payload)->assertOk();
        $this->assertDatabaseHas('tours', ['id' => $legacy, 'certification_id' => $template]);
        $payload['certification_id'] = $template;
        $this->postJson($this->uri(), $payload)->assertUnprocessable()->assertJsonValidationErrors('certification_id');
        $this->assertDatabaseHas('tours', ['id' => $legacy, 'certification_id' => $template]);
    }

    public function test_city_selector_endpoints_query_the_actual_geographic_schema(): void
    {
        [$teacher, $payload] = $this->fixture();
        $this->actingAs($teacher)->getJson('/api/web/v1/teacher-panel/country')->assertOk()->assertJsonFragment(['slug' => 'creation-country']);
        $this->getJson('/api/web/v1/teacher-panel/country/creation-country')->assertOk()->assertJsonFragment(['id' => $payload['location_id']]);
    }

    private function fixture(): array
    {
        Language::firstOrCreate(['slug' => 'en'], ['title' => 'English', 'preferred_currencies' => []]);
        $teacher = $this->user('teacher', 'teacher');
        $region = DB::table('regions')->insertGetId(['name' => 'Creation region', 'slug' => 'creation-region']);
        $country = DB::table('countries')->insertGetId(['name' => 'Creation country', 'slug' => 'creation-country', 'code' => 'XT', 'phone' => '+000', 'region_id' => $region]);
        $city = DB::table('cities')->insertGetId(['name' => 'Creation city', 'slug' => 'creation-city', 'country_id' => $country, 'latitude' => '0', 'longitude' => '0']);
        return [$teacher, [
            'title' => 'Synthetic multi day tour', 'subtitle' => 'Synthetic subtitle', 'tour_overview' => 'Synthetic overview',
            'short_summary' => 'Synthetic summary', 'location_id' => $city, 'age' => [20, 37], 'skills' => ['Leadership'],
            'evaluation_type' => 'noEvaluation', 'min_score' => null,
            'highlights' => [['title' => 'Scenic views']], 'includes' => [['title' => 'Included meals']],
            'excludes' => [['title' => 'Excluded flights']],
            'itineraries' => [
                ['id' => 2, 'title' => 'Explore region', 'description' => 'Synthetic exploration', 'start' => 2, 'end' => 3],
                ['id' => 1, 'title' => 'Arrival day', 'description' => 'Synthetic arrival', 'start' => 1, 'end' => 1],
            ],
        ]];
    }

    private function user(string $name, string $role): User
    {
        $user = User::withoutEvents(fn () => User::create(['fname' => 'Synthetic', 'lname' => $name, 'slug' => 'tour-create-'.$name,
            'email' => 'tour-create-'.$name.'@example.test', 'password' => 'unused', 'sex' => 1]));
        $user->addRole(Role::firstOrCreate(['name' => $role], ['display_name' => ucfirst($role)]));
        return $user;
    }

    private function uri(): string { return '/api/web/v1/teacher-panel/tours'; }
}
