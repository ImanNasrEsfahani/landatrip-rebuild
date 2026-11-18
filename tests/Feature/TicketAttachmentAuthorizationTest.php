<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TemporaryUpload;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TicketAttachmentAuthorizationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_new_attachment_bytes_require_ticket_authorization_and_are_never_public(): void
    {
        Event::fake();
        Storage::fake('private');
        Storage::fake('public');
        $owner = $this->user('owner');
        $outsider = $this->user('outsider');
        $support = $this->user('support', 'admin');
        $ticket = Ticket::create(['user_id' => $owner->id, 'title' => 'Synthetic ticket']);
        $this->actingAs($owner);
        $upload = app(TemporaryUpload::class)->store(UploadedFile::fake()->create('attachment.pdf', 1, 'application/pdf'));
        Storage::disk('private')->put('temporary-uploads/'.$upload->name, 'Synthetic private bytes');
        $this->postJson("/api/web/v1/user-panel/ticket/{$ticket->id}/record", ['message' => 'Attached', 'image' => $upload->id])->assertOk();
        $image = $ticket->records()->firstOrFail()->chatImage;
        $uri = $image->url;
        $this->assertStringStartsWith('/api/ticket-attachments/', $uri);
        Storage::disk('public')->assertMissing('users/chat/'.$upload->name);
        Storage::disk('private')->assertExists('ticket-attachments/'.$upload->name);
        $response = $this->get($uri)->assertOk()->assertHeader('Content-Type', 'application/octet-stream')
            ->assertHeader('X-Content-Type-Options', 'nosniff')->assertDownload('attachment-'.$image->id);
        $this->assertSame('Synthetic private bytes', $response->streamedContent());
        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
        $this->actingAs($outsider)->getJson($uri)->assertNotFound();
        $this->actingAs($support)->get($uri)->assertOk(); // authorized unassigned-ticket triage
        $ticket->update(['assigned_agent_id' => $support->id]);
        $this->get($uri)->assertOk();
        $differentAdmin = $this->user('different-admin', 'admin');
        $this->actingAs($differentAdmin)->getJson($uri)->assertNotFound();

        Storage::disk('private')->delete('ticket-attachments/'.$upload->name);
        Storage::disk('public')->put('ticket-attachments/'.$upload->name, 'No fallback');
        $this->actingAs($owner)->getJson($uri.'?file=unrelated.pdf')->assertNotFound();
        $image->update(['url' => '../unrelated.pdf']);
        $this->getJson($uri)->assertNotFound();
    }

    public function test_legacy_urls_are_preserved_and_private_route_rejects_legacy_or_unrelated_images(): void
    {
        Event::fake();
        $owner = $this->user('owner');
        $image = Image::create(['url' => 'legacy.png', 'image_type' => 'profile', 'alt' => 'Synthetic legacy',
            'parentable_id' => $owner->id, 'parentable_type' => User::class]);
        $this->assertSame('legacy.png', $image->url);
        $uri = '/api/ticket-attachments/'.$image->id.'/download';
        $this->getJson($uri)->assertUnauthorized();
        $this->actingAs($owner)->getJson($uri)->assertNotFound();
        $image->update(['private_attachment' => true]);
        $this->getJson($uri)->assertNotFound();
    }

    private function user(string $name, string $role = 'user'): User
    {
        $user = User::create(['fname' => 'Synthetic', 'lname' => $name, 'slug' => 'attachment-'.$name,
            'email' => 'attachment-'.$name.'@example.test', 'password' => 'unused', 'sex' => 1]);
        $user->addRole(Role::firstOrCreate(['name' => $role], ['display_name' => ucfirst($role)]));
        return $user;
    }
}
