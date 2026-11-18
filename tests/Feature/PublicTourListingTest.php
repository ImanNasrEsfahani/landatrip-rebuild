<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\TestCase;

class PublicTourListingTest extends TestCase
{
    use DatabaseTransactions;

    public function test_listing_filters_visibility_language_and_title_with_stable_pagination(): void
    {
        Event::fake();
        $language = Language::firstOrCreate(['slug' => 'en'], ['title' => 'English', 'preferred_currencies' => []]);
        $otherLanguage = Language::firstOrCreate(['slug' => 'fr'], ['title' => 'French', 'preferred_currencies' => []]);
        $user = User::create(['fname' => 'Synthetic', 'lname' => 'Teacher', 'slug' => 'tour-list-teacher',
            'email' => 'tour-list-teacher@example.test', 'password' => 'unused', 'sex' => 1]);
        $ids = [];
        for ($i = 1; $i <= 14; $i++) {
            $ids[] = $this->tour($user->id, $language->id, sprintf('Visible %02d', $i));
        }
        $this->tour($user->id, $language->id, 'Hidden draft', 0);
        $this->tour($user->id, $otherLanguage->id, 'Foreign visible');
        $queries = [];
        DB::listen(function ($query) use (&$queries) { if (str_contains($query->sql, 'from `tours`')) $queries[] = $query->sql; });
        $response = $this->get('/tour')->assertOk();
        $listing = $response->viewData('listing');
        $this->assertSame(14, $listing['total']);
        $this->assertSame(array_slice($ids, 0, 12), $listing['items']->pluck('id')->all());
        $this->assertCount(2, $queries); // count + page query, with group counts in SQL
        $this->assertCount(2, $this->get('/tour?page=2')->viewData('listing')['items']);
        $filtered = $this->get('/tour?q=Visible+14')->assertOk()->viewData('listing');
        $this->assertSame(1, $filtered['total']);
        $this->assertSame($ids[13], $filtered['items']->first()['id']);
        $this->assertSame(0, $this->get('/tour?q=missing')->viewData('listing')['total']);
        $this->assertSame(0, $this->get('/tour?q=%25')->viewData('listing')['total']);
    }

    public function test_group_counts_exclude_drafts_and_canceled_groups(): void
    {
        Event::fake();
        $language = Language::firstOrCreate(['slug' => 'en'], ['title' => 'English', 'preferred_currencies' => []]);
        $user = User::create(['fname' => 'Synthetic', 'lname' => 'Groups', 'slug' => 'tour-list-groups',
            'email' => 'tour-list-groups@example.test', 'password' => 'unused', 'sex' => 1]);
        $tour = $this->tour($user->id, $language->id, 'Published groups tour');
        foreach ([0, 2, 7] as $status) {
            DB::table('groups')->insert(['id' => (string) Str::ulid(), 'tour_id' => $tour, 'language_id' => $language->id,
                'title' => 'Synthetic group', 'slug' => 'synthetic-group-'.$status,
                'start_registration_date' => now()->subDay()->toDateString(), 'end_registration_date' => now()->addDay()->toDateString(),
                'start_date_tour' => now()->addMonth()->toDateString(), 'end_date_tour' => now()->addMonth()->addDays(3)->toDateString(),
                'days' => 3, 'nights' => 2, 'min_capacity' => 1, 'max_capacity' => 10, 'status' => $status,
                'created_at' => now(), 'updated_at' => now()]);
        }
        $item = $this->get('/tour?q=Published+groups')->assertOk()->viewData('listing')['items']->first();
        $this->assertSame(1, $item['groups']);
        $this->assertStringContainsString('/tour/', $item['url']);
        $this->assertArrayNotHasKey('price', $item);
    }

    private function tour(string $user, int $language, string $title, int $status = 2): string
    {
        $id = (string) Str::ulid();
        DB::table('tours')->insert(['id' => $id, 'user_id' => $user, 'certification_id' => (string) Str::ulid(),
            'teacher_name' => 'Synthetic Teacher', 'language_id' => $language, 'title' => $title,
            'slug' => Str::slug($title).'-'.$id, 'short_summary' => 'Synthetic summary', 'city_id' => 1,
            'tour_overview' => 'Synthetic overview', 'status' => $status]);
        return $id;
    }
}
