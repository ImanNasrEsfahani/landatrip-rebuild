<?php

namespace Tests\Feature;

use App\Models\TemporaryFiles;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LegacyTemporaryUploadAdapterTest extends TestCase
{
    use DatabaseTransactions;

    public function test_legacy_process_returns_an_owned_private_upload_id(): void
    {
        Event::fake();
        Storage::fake('private');
        Storage::fake('public');
        $user = User::create(['fname' => 'Synthetic', 'lname' => 'Adapter', 'slug' => 'legacy-adapter',
            'email' => 'legacy-adapter@example.test', 'password' => 'unused', 'sex' => 1]);
        $uri = '/api/files/upload/temp-store';
        $this->postJson($uri)->assertUnauthorized();
        $this->actingAs($user)->postJson($uri)->assertUnprocessable();
        $this->postJson($uri, ['file' => UploadedFile::fake()->create('script.php', 1, 'text/x-php')])->assertUnprocessable();
        $response = $this->post($uri, ['file' => UploadedFile::fake()->image('header.png')])->assertOk();
        $this->assertMatchesRegularExpression('/^\d+$/', $response->getContent());
        $file = TemporaryFiles::findOrFail($response->getContent());
        $this->assertSame($user->id, $file->owner_id);
        $this->assertNotNull($file->expires_at);
        Storage::disk('private')->assertExists('temporary-uploads/'.$file->name);
        $this->assertSame([], Storage::disk('public')->allFiles());
    }
}
