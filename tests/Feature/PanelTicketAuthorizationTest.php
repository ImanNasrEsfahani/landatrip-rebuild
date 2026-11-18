<?php

namespace Tests\Feature;

use App\Enums\TicketStatusEnum;
use App\Models\Role;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PanelTicketAuthorizationTest extends TestCase
{
    use DatabaseTransactions;

    public static function accessCases(): array
    {
        return [
            'user owner' => ['user', 'owned', 200],
            'user non-owner' => ['user', 'other', 404],
            'teacher owner' => ['teacher', 'owned', 200],
            'teacher non-owner' => ['teacher', 'other', 404],
            'assigned global admin' => ['admin', 'assigned', 200],
            'global admin triaging an unassigned ticket' => ['admin', 'unassigned', 200],
            'unassigned admin on another admin ticket' => ['admin', 'other', 404],
            'team-only admin' => ['admin', 'team', 404],
        ];
    }

    #[DataProvider('accessCases')]
    public function test_ticket_detail_and_records_are_scoped(string $role, string $relation, int $status): void
    {
        Event::fake();
        $owner = $this->user('owner', $role === 'admin' ? 'user' : $role);
        $requester = $relation === 'owned' ? $owner : $this->user('requester', $role, $relation === 'team');
        $assignee = match ($relation) {
            'assigned', 'team' => $requester->id,
            'other' => $this->user('support', 'admin')->id,
            default => null,
        };
        $ticket = Ticket::create(['user_id' => $owner->id, 'assigned_agent_id' => $assignee, 'title' => 'Synthetic ticket']);
        $ticket->records()->create(['user_id' => $owner->id, 'message' => 'Synthetic ticket message']);
        $root = "/api/web/v1/$role-panel/".($role === 'admin' ? 'tickets' : 'ticket')."/{$ticket->id}";
        $this->getJson("$root/record")->assertUnauthorized();

        $this->actingAs($requester)->getJson($root)->assertStatus($status);
        $records = $this->getJson("$root/record")->assertStatus($status);
        if ($status === 200) {
            $records->assertJsonPath('data.0.message', 'Synthetic ticket message');
            if ($role !== 'admin') {
                $this->postJson("$root/record", ['message' => 'Synthetic owner reply'])->assertOk();
                $this->assertDatabaseHas('ticket_records', [
                    'ticket_id' => $ticket->id, 'user_id' => $owner->id, 'message' => 'Synthetic owner reply',
                ]);
            }
        } else {
            $records->assertJsonMissingPath('data');
            $this->postJson("$root/record", ['message' => 'Synthetic denied reply'])->assertNotFound();
            $this->assertDatabaseMissing('ticket_records', ['message' => 'Synthetic denied reply']);
            if ($role === 'admin') {
                $this->postJson("$root/assign-me")->assertNotFound();
                $this->putJson($root, [])->assertNotFound();
                $this->assertSame($assignee, $ticket->fresh()->assigned_agent_id);
            }
        }

        if ($role === 'user') {
            $rating = $this->postJson("$root/rating", ['rating' => 4])->assertStatus($status);
            if ($status === 200) {
                $rating->assertContent('test');
            }
        }

        $closingUri = $role === 'admin' ? str_replace('/tickets/', '/ticket/', $root) : $root;
        $closeAllowed = $status === 200 && $relation !== 'unassigned';
        $oldStatus = $ticket->fresh()->status->value;
        $this->postJson("$closingUri/closing", ['rate' => 4])->assertStatus($closeAllowed ? 200 : 404);
        $this->assertSame(
            $closeAllowed ? ($role === 'admin' ? TicketStatusEnum::rating : TicketStatusEnum::closed) : $oldStatus,
            $ticket->fresh()->status->value,
        );
    }

    public function test_global_support_admin_can_claim_an_unassigned_ticket_and_reply(): void
    {
        Event::fake();
        $owner = $this->user('owner', 'user');
        $admin = $this->user('support', 'admin');
        $ticket = Ticket::create(['user_id' => $owner->id, 'title' => 'Synthetic ticket']);
        $root = "/api/web/v1/admin-panel/tickets/{$ticket->id}";
        $this->actingAs($admin)->postJson("$root/assign-me")->assertOk();
        $this->assertSame($admin->id, $ticket->fresh()->assigned_agent_id);
        $this->postJson("$root/record", ['message' => 'Synthetic support reply'])->assertOk();
        $this->assertDatabaseHas('ticket_records', ['ticket_id' => $ticket->id, 'user_id' => $admin->id, 'message' => 'Synthetic support reply']);

        $this->putJson($root, [
            'id' => $ticket->id,
            'user_id' => $admin->id,
            'assigned_agent_id' => $owner->id,
            'title' => 'Synthetic updated title',
            'priority' => $ticket->fresh()->priority->value,
            'status' => $ticket->fresh()->status->value,
        ])->assertOk();
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id, 'user_id' => $owner->id, 'assigned_agent_id' => $admin->id,
            'title' => 'Synthetic updated title',
        ]);
    }

    public function test_support_creates_tickets_only_for_the_selected_recipients(): void
    {
        Event::fake();
        $unselected = $this->user('unselected', 'user');
        $recipient = $this->user('recipient', 'user');
        $admin = $this->user('support', 'admin');
        $payload = [
            'users' => [$recipient->id],
            'title' => 'Synthetic requested ticket',
            'priority' => 1,
            'message' => 'Synthetic requested message',
        ];

        $this->actingAs($admin)->postJson('/api/web/v1/admin-panel/tickets', $payload)->assertOk();
        $this->assertDatabaseHas('tickets', [
            'title' => $payload['title'], 'user_id' => $recipient->id, 'assigned_agent_id' => $admin->id,
        ]);
        $this->assertDatabaseMissing('tickets', ['title' => $payload['title'], 'user_id' => $unselected->id]);
    }

    public function test_ticket_recipient_search_requires_global_support_role(): void
    {
        Event::fake();
        $this->user('recipient', 'user');
        $teamAdmin = $this->user('team-admin', 'admin', true);
        $globalAdmin = $this->user('global-admin', 'admin');
        $uri = '/api/web/v1/admin-panel/ticket/search';

        $this->actingAs($teamAdmin)->postJson($uri, ['keyword' => 'Synthetic'])->assertForbidden();
        $this->actingAs($globalAdmin)->postJson($uri, ['keyword' => 'Synthetic'])
            ->assertOk()->assertJsonFragment(['short_label' => 'Synthetic recipient']);
    }

    private function user(string $name, string $role, bool $teamOnly = false): User
    {
        $user = User::create([
            'fname' => 'Synthetic', 'lname' => $name, 'slug' => "panel-fixture-$name",
            'email' => "panel-fixture-$name@example.test", 'password' => 'unused-by-fixture', 'sex' => 1,
        ]);
        $team = $teamOnly ? Team::create(['name' => 'panel-fixture-team', 'display_name' => 'Fixture']) : null;
        $user->addRole(Role::firstOrCreate(['name' => $role], ['display_name' => ucfirst($role)]), $team);
        $user->images()->create(['url' => 'fixture-profile.png', 'image_type' => 'profile', 'alt' => 'Fixture']);
        return $user;
    }
}
