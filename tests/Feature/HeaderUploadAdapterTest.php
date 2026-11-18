<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HeaderUploadAdapterTest extends TestCase
{
    use DatabaseTransactions;

    public function test_header_keeps_the_image_id_contract_and_updates_only_the_authenticated_user(): void
    {
        Event::fake();
        Storage::fake('private');
        Storage::fake('public');
        $user = User::create(['fname' => 'Synthetic', 'lname' => 'Header', 'slug' => 'header-adapter',
            'email' => 'header-adapter@example.test', 'password' => 'unused', 'sex' => 1]);
        $uri = '/api/user/unrelated-user/header';
        $this->postJson($uri)->assertUnauthorized();
        $this->actingAs($user)->postJson($uri)->assertUnprocessable();
        $this->postJson($uri, ['files' => UploadedFile::fake()->create('script.php', 1, 'text/x-php')])->assertUnprocessable();
        $response = $this->post($uri, ['files' => UploadedFile::fake()->image('header.png')])->assertOk();
        $image = Image::findOrFail($response->getContent());
        $this->assertSame($user->id, $image->parentable_id);
        $this->assertSame('header', $image->image_type);
        $this->assertMatchesRegularExpression('/^[0-9a-f-]{36}\.png$/', $image->url);
        Storage::disk('public')->assertExists('users/header/'.$image->url);
        $this->assertDatabaseHas('temporary_files', ['owner_id' => $user->id, 'name' => $image->url]);
        $this->assertNotNull(\App\Models\TemporaryFiles::where('name', $image->url)->firstOrFail()->consumed_at);
    }
}
