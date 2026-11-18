<?php

namespace Tests\Feature;

use App\Events\ListEvent;
use App\Models\Conversation;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ConversationAuthorizationTest extends TestCase
{
    use DatabaseTransactions;

    public static function members(): array
    {
        return [
            'owner' => ['owner', true],
            'assigned participant' => ['member', true],
            'non-participant' => ['outsider', false],
            'different team' => ['other-team', false],
        ];
    }

    #[DataProvider('members')]
    public function test_http_records_and_broadcast_channels_require_membership(string $actor, bool $allowed): void
    {
        Event::fake();
        config([
            'broadcasting.default' => 'pusher',
            'broadcasting.connections.pusher' => [
                'driver' => 'pusher', 'key' => 'fixture', 'secret' => 'fixture', 'app_id' => 'fixture',
                'options' => ['cluster' => 'mt1'],
            ],
        ]);
        require base_path('routes/channels.php');

        $owner = $this->fixtureUser('owner');
        $member = $this->fixtureUser('member');
        $conversation = Conversation::create([
            'user_id' => $owner->id, 'assigned_by' => $member->id, 'title' => 'Synthetic conversation',
        ]);
        $conversation->records()->create(['user_id' => $owner->id, 'message' => 'Synthetic message']);
        $uri = "/api/web/v1/user-panel/conversation/{$conversation->id}";
        $auth = ['channel_name' => "private-chat.{$conversation->id}", 'socket_id' => '1.1'];
        $this->getJson($uri)->assertUnauthorized();
        $this->postJson('/broadcasting/auth', $auth)->assertForbidden();

        $requester = match ($actor) {
            'owner' => $owner,
            'member' => $member,
            default => $this->fixtureUser($actor),
        };
        $this->actingAs($requester);
        $response = $this->getJson($uri)->assertStatus($allowed ? 200 : 404);
        if ($allowed) {
            $response->assertJsonFragment(['message' => 'Synthetic message']);
        } else {
            $response->assertJsonMissingPath('data');
        }
        $this->putJson($uri, ['message' => 'Synthetic reply'])->assertStatus($allowed ? 200 : 404);
        $this->assertSame($allowed ? 2 : 1, $conversation->records()->count());
        $this->postJson('/broadcasting/auth', $auth)->assertStatus($allowed ? 200 : 403);
        $this->postJson('/broadcasting/auth', [
            'channel_name' => "private-list-channel.{$requester->id}", 'socket_id' => '1.1',
        ])->assertOk();

        $other = $requester->is($owner) ? $member : $owner;
        $this->postJson('/broadcasting/auth', [
            'channel_name' => "private-list-channel.{$other->id}", 'socket_id' => '1.1',
        ])->assertForbidden();
        $this->postJson('/broadcasting/auth', ['channel_name' => 'private-list-channel', 'socket_id' => '1.1'])
            ->assertForbidden();

        $event = new ListEvent($conversation->id, [], [], $owner->id, $member->id);
        $this->assertSame(["private-list-channel.{$owner->id}", "private-list-channel.{$member->id}"],
            array_map(fn ($channel) => $channel->name, $event->broadcastOn()));
    }

    private function fixtureUser(string $name): User
    {
        $user = User::create([
            'fname' => 'Synthetic', 'lname' => $name, 'slug' => "chat-fixture-$name",
            'email' => "chat-fixture-$name@example.test", 'password' => 'unused-by-fixture', 'sex' => 1,
        ]);
        $role = Role::firstOrCreate(['name' => 'user'], ['display_name' => 'User']);
        $user->addRole($role, $name === 'other-team'
            ? Team::create(['name' => 'chat-fixture-team', 'display_name' => 'Fixture team']) : null);
        $user->images()->create(['url' => 'fixture-profile.png', 'image_type' => 'profile', 'alt' => 'Fixture']);
        return $user;
    }
}
