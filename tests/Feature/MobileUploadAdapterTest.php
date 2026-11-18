<?php

namespace Tests\Feature;

use App\Models\TemporaryFiles;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MobileUploadAdapterTest extends TestCase
{
    use DatabaseTransactions;

    public function test_mobile_upload_returns_the_approved_url_contract_and_private_owner_download(): void
    {
        Event::fake();
        Storage::fake('private');
        Storage::fake('public');
        $owner = $this->user('owner');
        $other = $this->user('other');
        $this->postJson('/api/app/v1/file-upload')->assertUnauthorized();
        $token = $owner->createToken('synthetic')->plainTextToken;
        $this->withToken($token)->postJson('/api/app/v1/file-upload')->assertUnprocessable();
        $response = $this->postJson('/api/app/v1/file-upload', ['file' => UploadedFile::fake()->create('document.pdf', 1, 'application/pdf')])
            ->assertCreated()->assertHeader('Content-Type', 'application/json');
        $this->assertSame(['data'], array_keys($response->json()));
        $url = $response->json('data');
        $this->assertSame('http', parse_url($url, PHP_URL_SCHEME));
        $file = TemporaryFiles::where('owner_id', $owner->id)->firstOrFail();
        Storage::disk('private')->put('temporary-uploads/'.$file->name, 'Synthetic private bytes');
        $this->get($url)->assertOk();
        $this->assertSame('Synthetic private bytes', $this->get($url)->streamedContent());
        $this->assertSame([], Storage::disk('public')->allFiles());
        // Reset authentication cache before testing a second bearer token.
        $this->app['auth']->forgetGuards();
        $this->withToken($other->createToken('synthetic')->plainTextToken)->getJson($url)->assertNotFound();
        $this->app['auth']->forgetGuards();
        $this->withToken($token);
        $file->update(['expires_at' => now()->subSecond()]);
        $this->getJson($url)->assertNotFound();
    }

    private function user(string $name): User
    {
        return User::create(['fname' => 'Synthetic', 'lname' => $name, 'slug' => 'mobile-upload-'.$name,
            'email' => 'mobile-upload-'.$name.'@example.test', 'password' => 'unused', 'sex' => 1]);
    }
}
