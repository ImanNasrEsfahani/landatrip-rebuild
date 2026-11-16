<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class InvoiceOwnershipTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_panel_shows_only_the_owner_invoice(): void
    {
        Event::fake();
        $role = Role::firstOrCreate(['name' => 'user'], ['display_name' => 'User']);
        $owner = User::create([
            'fname' => 'Invoice', 'lname' => 'Owner', 'slug' => 'invoice-owner',
            'email' => 'invoice-owner@example.invalid', 'password' => 'unused', 'sex' => 1,
        ]);
        $other = User::create([
            'fname' => 'Invoice', 'lname' => 'Other', 'slug' => 'invoice-other',
            'email' => 'invoice-other@example.invalid', 'password' => 'unused', 'sex' => 1,
        ]);
        $owner->addRole($role);
        $other->addRole($role);
        $invoice = Invoice::create([
            'title' => 'Fixture invoice', 'user_id' => $owner->id,
            'total' => 250, 'subtotal' => 250, 'discount' => 0, 'tax' => 0,
            'expire' => now()->addDay(),
        ]);

        $this->actingAs($owner)->getJson('/api/web/v1/user-panel/invoices/' . $invoice->id)
            ->assertOk()->assertJsonPath('data.id', $invoice->id);
        $this->actingAs($other)->getJson('/api/web/v1/user-panel/invoices/' . $invoice->id)
            ->assertNotFound();
    }
}
