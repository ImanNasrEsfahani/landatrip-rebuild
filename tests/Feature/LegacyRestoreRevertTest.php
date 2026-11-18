<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\TemporaryUpload;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LegacyRestoreRevertTest extends TestCase
{
    use DatabaseTransactions;

    public function test_restore_is_owner_scoped_and_revert_expires_without_deleting_bytes(): void
    {
        Event::fake();
        Storage::fake('private');
        $owner = $this->user('owner');
        $other = $this->user('other');
        $this->actingAs($owner);
        $file = app(TemporaryUpload::class)->store(UploadedFile::fake()->image('photo.png'));
        $uri = '/api/files/upload?restore='.$file->id;
        $this->get($uri)->assertOk();
        $this->getJson('/api/files/upload?restore=../file')->assertUnprocessable();
        $this->actingAs($other)->getJson($uri)->assertNotFound();
        $this->call('DELETE', '/api/files/upload', [], [], [], ['CONTENT_TYPE' => 'text/plain'], (string) $file->id)->assertNotFound();
        $this->actingAs($owner)->call('DELETE', '/api/files/upload', [], [], [], ['CONTENT_TYPE' => 'text/plain'], (string) $file->id)->assertNoContent();
        $this->getJson($uri)->assertNotFound();
        $this->deleteJson('/api/temporary-file/'.$file->id)->assertNoContent();
        Storage::disk('private')->assertExists('temporary-uploads/'.$file->name);
        $this->assertDatabaseHas('temporary_files', ['id' => $file->id, 'owner_id' => $owner->id]);
        $this->assertTrue(now()->gte($file->fresh()->expires_at));
    }

    private function user(string $name): User
    {
        return User::create(['fname' => 'Synthetic', 'lname' => $name, 'slug' => 'restore-'.$name,
            'email' => 'restore-'.$name.'@example.test', 'password' => 'unused', 'sex' => 1]);
    }
}
