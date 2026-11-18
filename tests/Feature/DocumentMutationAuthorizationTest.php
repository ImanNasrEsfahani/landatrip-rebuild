<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\TemporaryFiles;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class DocumentMutationAuthorizationTest extends TestCase
{
    use DatabaseTransactions;

    public static function panelRoles(): array
    {
        return ['user panel' => ['user'], 'teacher panel' => ['teacher']];
    }

    #[DataProvider('panelRoles')]
    public function test_only_the_owner_can_modify_or_delete_an_existing_document(string $role): void
    {
        Event::fake();
        Storage::fake('public');
        $owner = $this->user("$role-owner", $role);
        $other = $this->user("$role-other", $role);
        $document = UserDocument::create([
            'user_id' => $owner->id, 'title' => 'Original document',
            'type' => 'text/plain', 'file' => 'original.txt',
        ]);
        Storage::disk('public')->put('users/documents/original.txt', 'Synthetic original');
        Storage::disk('public')->put('tmp-files/replacement.txt', 'Synthetic replacement');
        $temporary = TemporaryFiles::create([
            'name' => 'replacement.txt', 'type' => 'text/plain', 'size' => '21',
        ]);
        $uri = "/api/web/v1/{$role}-panel/account-info/documents/{$document->id}";
        $payload = ['title' => 'Updated document', 'file' => $temporary->id];

        $this->putJson($uri, $payload)->assertUnauthorized();
        $this->actingAs($other)->putJson($uri, $payload)->assertNotFound();
        $this->deleteJson($uri)->assertNotFound();
        $this->assertDatabaseHas('user_documents', [
            'id' => $document->id, 'user_id' => $owner->id, 'title' => 'Original document',
        ]);

        $this->actingAs($owner)->putJson($uri, $payload)->assertOk();
        $this->assertDatabaseHas('user_documents', [
            'id' => $document->id, 'user_id' => $owner->id,
            'title' => $role === 'user' ? 'Updated document' : 'Original document',
            'file' => $role === 'user' ? 'replacement.txt' : 'original.txt',
        ]);
        $this->deleteJson($uri)->assertOk();
        $this->assertDatabaseMissing('user_documents', ['id' => $document->id]);
        Storage::disk('public')->assertExists('users/documents/original.txt');
        $this->deleteJson($uri)->assertNotFound();
    }

    private function user(string $name, string $role): User
    {
        $user = User::create([
            'fname' => 'Synthetic', 'lname' => $name, 'slug' => "document-mutation-$name",
            'email' => "document-mutation-$name@example.test", 'password' => 'unused-by-fixture', 'sex' => 1,
        ]);
        $user->addRole(Role::firstOrCreate(['name' => $role], ['display_name' => ucfirst($role)]));

        return $user;
    }
}
