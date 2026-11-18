<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class MobileTicketAuthorizationTest extends TestCase
{
    use DatabaseTransactions;

    public static function accessCases(): array
    {
        return [
            'owner' => ['owner', 200],
            'assigned support admin' => ['assigned', 200],
            'another account' => ['other', 404],
            'unassigned support admin' => ['unassigned', 404],
            'team-only admin assigned to ticket' => ['team', 404],
            'anonymous' => ['anonymous', 401],
            'invalid token' => ['invalid', 401],
            'missing ticket' => ['missing', 404],
        ];
    }

    #[DataProvider('accessCases')]
    public function test_mobile_ticket_records_respect_the_account_boundary(string $actor, int $status): void
    {
        $this->freezeTime();
        Event::fake();
        Log::spy(); // Keep synthetic bearer credentials out of baseline debug logs.
        $userRole = Role::firstOrCreate(['name' => 'user'], ['display_name' => 'User']);
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['display_name' => 'Admin']);
        $owner = $this->fixtureUser('owner');
        $owner->addRole($userRole);

        $assignee = $this->fixtureUser('assignee');
        if ($actor === 'team') {
            $team = Team::create(['name' => 'fixture-team', 'display_name' => 'Other fixture team']);
            $assignee->addRole($adminRole, $team);
        } else {
            $assignee->addRole($adminRole);
        }

        $ticket = Ticket::create([
            'user_id' => $owner->id,
            'assigned_agent_id' => $assignee->id,
            'title' => 'Synthetic case title',
        ]);
        $owner->images()->create(['url' => 'fixture-profile.png', 'image_type' => 'profile', 'alt' => 'Fixture']);
        $record = $ticket->records()->create(['user_id' => $owner->id, 'message' => 'Synthetic case message']);
        $record->images()->create(['url' => 'fixture-private.png', 'image_type' => 'chat', 'alt' => 'Fixture']);

        $requester = match ($actor) {
            'owner', 'missing' => $owner,
            'assigned', 'team' => $assignee,
            'other', 'unassigned' => $this->fixtureUser($actor),
            default => null,
        };
        if ($actor === 'unassigned') {
            $requester->addRole($adminRole);
        }
        if ($requester) {
            $this->withToken($requester->createToken('mobile-ticket-fixture')->plainTextToken);
        } elseif ($actor === 'invalid') {
            $this->withToken('synthetic-invalid-token');
        }

        $ticketId = $actor === 'missing' ? (string) Str::ulid() : $ticket->id;
        $response = $this->getJson('/api/app/v1/ticket/'.$ticketId)->assertStatus($status);

        if ($status === 200) {
            $response->assertExactJson(['data' => [[
                'ticket_title' => $ticket->title,
                'name' => $owner->name,
                'profile' => Storage::url('/users/profile/fixture-profile.png'),
                'role_user' => $userRole->display_name,
                'message' => $record->message,
                'seen' => null,
                'created_at' => $record->created_at->diffForHumans(),
            ]]]);
        } else {
            $response->assertJsonMissingPath('data')
                ->assertDontSee($ticket->title)
                ->assertDontSee($record->message)
                ->assertDontSee('fixture-private.png');
        }
    }

    private function fixtureUser(string $name): User
    {
        return User::create([
            'fname' => 'Ticket',
            'lname' => $name,
            'slug' => 'ticket-fixture-'.$name,
            'email' => 'ticket-fixture-'.$name.'@example.test',
            'password' => 'unused-by-ticket-fixture',
            'sex' => 1,
        ]);
    }
}
