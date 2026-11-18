<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PrivateDocumentDownloadTest extends TestCase
{
    use DatabaseTransactions;

    public function test_only_the_owner_can_download_a_private_document(): void
    {
        Event::fake();
        Storage::fake('private');
        Storage::fake('public');
        $owner = $this->fixtureUser('owner');
        $other = $this->fixtureUser('other');
        $document = $this->document($owner);
        Storage::disk('private')->put("user-documents/{$document->id}/content", 'Synthetic private document');
        $uri = "/api/documents/{$document->id}/download";

        $this->getJson($uri)->assertUnauthorized();
        $this->actingAs($other)->getJson($uri)->assertNotFound();
        $response = $this->actingAs($owner)->get($uri)
            ->assertOk()
            ->assertDownload("document-{$document->id}")
            ->assertHeader('Content-Type', 'application/octet-stream')
            ->assertHeader('X-Content-Type-Options', 'nosniff');
        $this->assertSame('Synthetic private document', $response->streamedContent());
        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
        $this->assertStringContainsString('private', $response->headers->get('Cache-Control'));
    }

    public function test_route_never_falls_back_to_public_or_client_selected_paths(): void
    {
        Event::fake();
        Storage::fake('private');
        Storage::fake('public');
        $owner = $this->fixtureUser('owner');
        $document = $this->document($owner);
        $path = "user-documents/{$document->id}/content";
        Storage::disk('public')->put($path, 'Synthetic public document');
        Storage::disk('private')->put('unrelated/file', 'Synthetic unrelated file');

        $this->actingAs($owner)->getJson("/api/documents/{$document->id}/download?file=unrelated/file")->assertNotFound();
        $this->getJson('/api/documents/not-a-number/download')->assertNotFound();
    }

    private function fixtureUser(string $name): User
    {
        return User::create([
            'fname' => 'Synthetic', 'lname' => $name, 'slug' => "document-fixture-$name",
            'email' => "document-fixture-$name@example.test", 'password' => 'unused-by-fixture', 'sex' => 1,
        ]);
    }

    private function document(User $owner): UserDocument
    {
        return UserDocument::create([
            'user_id' => $owner->id, 'title' => 'Synthetic document', 'type' => 'text/plain',
            'file' => '../unrelated/file',
        ]);
    }
}
