<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class MobileFeedQueryTest extends TestCase
{
    use DatabaseTransactions;

    public static function feedCases(): array
    {
        return [
            'distinct timestamps' => [false, 2],
            'one author with tied timestamps' => [true, 3],
        ];
    }

    #[DataProvider('feedCases')]
    public function test_mobile_feed_reuses_loaded_posts_without_reordering_ties(bool $hasTie, int $queryCount): void
    {
        $this->freezeTime();
        Event::fake();
        Log::spy();
        $viewer = $this->fixtureUser('viewer');

        for ($i = 1; $i <= 4; $i++) {
            $author = $this->fixtureUser("followee-$i");
            $viewer->following()->attach($author);
            $this->postAt($author, 10);
            $this->postAt($author, $hasTie && $i === 2 ? 10 : 5);
        }

        $this->postAt($this->fixtureUser('unfollowed'), 0);
        $legacyIds = $viewer->following()->get()
            ->flatMap(fn (User $author) => $author->userPosts()->get()->pluck('id'))
            ->all();

        $token = $viewer->createToken('mobile-feed-fixture')->plainTextToken;
        DB::enableQueryLog();
        DB::flushQueryLog();
        try {
            $response = $this->withToken($token)->getJson('/api/app/v1/feed')->assertOk();
            $retrievalQueries = collect(DB::getQueryLog())->filter(
                fn ($entry) => preg_match('/\b(?:from\s+[\x60"]?user_posts\b|join\s+[\x60"]?followings\b)/i', $entry['query'])
            );
        } finally {
            DB::disableQueryLog();
            DB::flushQueryLog();
        }

        $response->assertJsonCount(8, 'data')->assertJsonStructure([
            'data' => [['post_id', 'user', 'title', 'location', 'type', 'image', 'likes', 'comment_count',
                'active', 'created_at', 'is_liked', 'is_saved', 'comments', 'post_url']],
        ]);
        $this->assertSame($legacyIds, array_column($response->json('data'), 'post_id'));
        $this->assertCount($queryCount, $retrievalQueries);
    }

    public function test_mobile_feed_requires_authentication(): void
    {
        Log::spy();
        $this->getJson('/api/app/v1/feed')->assertUnauthorized();
    }

    private function fixtureUser(string $name): User
    {
        return User::create([
            'fname' => 'Feed',
            'lname' => $name,
            'slug' => 'feed-fixture-'.$name,
            'email' => 'feed-fixture-'.$name.'@example.test',
            'password' => 'unused-by-feed-fixture',
            'sex' => 1,
        ]);
    }

    private function postAt(User $author, int $minutesAgo): void
    {
        $post = $author->userPosts()->make(['title' => 'Synthetic feed post', 'location' => 'Fixture']);
        $post->created_at = now()->subMinutes($minutesAgo);
        $post->save();
    }
}
