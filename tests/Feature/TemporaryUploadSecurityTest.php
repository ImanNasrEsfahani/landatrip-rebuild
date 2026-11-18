<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\TemporaryFiles;
use App\Models\User;
use App\Models\UserDocument;
use App\Services\TemporaryUpload;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TemporaryUploadSecurityTest extends TestCase
{
    use DatabaseTransactions;

    public function test_other_users_cannot_claim_uploads_and_owner_can_claim_only_once(): void
    {
        Event::fake();
        Storage::fake('private');
        Storage::fake('public');
        $owner = $this->user('owner');
        $other = $this->user('other');
        $this->actingAs($owner)->post('/api/temporary-file', ['file' => UploadedFile::fake()->create('document.pdf', 2, 'application/pdf')])->assertOk();
        $file = TemporaryFiles::where('owner_id', $owner->id)->firstOrFail();
        Storage::disk('private')->assertExists('temporary-uploads/'.$file->name);
        Storage::disk('public')->assertMissing('tmp-files/'.$file->name);
        $payload = ['title' => 'Synthetic document', 'file' => $file->id];
        $uri = '/api/web/v1/user-panel/account-info/documents';
        $this->actingAs($other)->postJson($uri, $payload)->assertNotFound();
        $this->assertDatabaseMissing('user_documents', ['title' => $payload['title']]);
        $this->actingAs($owner)->postJson($uri, $payload)->assertOk();
        $this->postJson($uri, $payload)->assertNotFound();
        $this->assertSame(1, UserDocument::where('file', $file->name)->count());
        $this->assertNotNull($file->fresh()->consumed_at);
    }

    public function test_expired_ownerless_and_unsafe_names_are_rejected_without_deleting_files(): void
    {
        Event::fake();
        Storage::fake('private');
        Storage::fake('public');
        $owner = $this->user('owner');
        $this->actingAs($owner);
        foreach ([
            ['owner_id' => null, 'expires_at' => now()->addDay()],
            ['owner_id' => $owner->id, 'expires_at' => now()->subSecond()],
            ['owner_id' => $owner->id, 'expires_at' => now()->addDay(), 'name' => '../unrelated.pdf'],
        ] as $metadata) {
            $file = TemporaryFiles::create(array_merge(['name' => 'legacy.pdf', 'type' => 'application/pdf', 'size' => '2'], $metadata));
            Storage::disk('public')->put('tmp-files/legacy.pdf', 'preserve');
            $this->postJson('/api/web/v1/user-panel/account-info/documents', ['title' => 'Denied document', 'file' => $file->id])->assertNotFound();
            Storage::disk('public')->assertExists('tmp-files/legacy.pdf');
        }
    }

    public function test_failed_consumer_rolls_back_database_and_destination_and_allows_retry(): void
    {
        Event::fake();
        Storage::fake('private');
        Storage::fake('public');
        $this->actingAs($this->user('owner'));
        $service = app(TemporaryUpload::class);
        $file = $service->store(UploadedFile::fake()->create('document.pdf', 2, 'application/pdf'));
        try {
            $service->consume($file->id, 'users/documents', function () {
                throw new \RuntimeException('Synthetic failure');
            });
            $this->fail('Consumer must fail');
        } catch (\RuntimeException $error) {
            $this->assertSame('Synthetic failure', $error->getMessage());
        }
        $this->assertNull($file->fresh()->consumed_at);
        Storage::disk('public')->assertMissing('users/documents/'.$file->name);
        Storage::disk('private')->assertExists('temporary-uploads/'.$file->name);
        $this->assertTrue($service->consume($file->id, 'users/documents', fn () => true));
    }

    public function test_upload_rejects_scripts_and_oversized_files(): void
    {
        Event::fake();
        Storage::fake('private');
        $this->actingAs($this->user('owner'));
        $this->postJson('/api/temporary-file', ['file' => UploadedFile::fake()->create('script.php', 1, 'text/x-php')])->assertUnprocessable();
        $this->postJson('/api/temporary-file', ['file' => UploadedFile::fake()->create('large.pdf', 10241, 'application/pdf')])->assertUnprocessable();
        $this->assertSame([], Storage::disk('private')->allFiles());
    }

    public function test_ticket_and_profile_consumers_reject_another_users_upload_before_mutation(): void
    {
        Event::fake();
        Storage::fake('private');
        Storage::fake('public');
        $owner = $this->user('owner');
        $other = $this->user('other');
        $this->actingAs($owner);
        $file = app(TemporaryUpload::class)->store(UploadedFile::fake()->image('profile.png'));
        $ticket = \App\Models\Ticket::create(['user_id' => $other->id, 'title' => 'Synthetic ticket']);
        $this->actingAs($other)->postJson("/api/web/v1/user-panel/ticket/{$ticket->id}/record", [
            'message' => 'Denied reply', 'image' => $file->id,
        ])->assertNotFound();
        $this->assertSame(0, $ticket->records()->count());
        $this->postJson('/api/web/v1/user-panel/account-info/profile-image', ['url' => $file->id])->assertNotFound();
        $this->assertNull($file->fresh()->consumed_at);
    }

    private function user(string $name): User
    {
        $user = User::create(['fname' => 'Synthetic', 'lname' => $name, 'slug' => 'upload-'.$name,
            'email' => 'upload-'.$name.'@example.test', 'password' => 'unused', 'sex' => 1]);
        $user->addRole(Role::firstOrCreate(['name' => 'user'], ['display_name' => 'User']));
        return $user;
    }
}
