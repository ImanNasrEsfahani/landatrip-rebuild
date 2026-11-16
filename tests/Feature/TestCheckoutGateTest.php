<?php

namespace Tests\Feature;

use App\Services\TestCheckout;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class TestCheckoutGateTest extends TestCase
{
    use DatabaseTransactions;

    public function test_fake_checkout_rejects_normal_application_configuration(): void
    {
        config()->set('booking_test.enabled', false);
        $this->postJson('/api/__e2e/checkout/callback', [
            'authority' => 'fake_'.str_repeat('a', 32), 'result' => 'success',
        ])->assertStatus(409);
        $user = User::withoutEvents(fn () => User::create([
            'fname' => 'Audit', 'lname' => 'Fixture', 'slug' => 'audit-'.Str::lower(Str::random(10)),
            'email' => 'audit-'.Str::lower(Str::random(10)).'@example.invalid',
            'password' => 'unused', 'email_verified_at' => now(),
        ]));
        $this->actingAs($user);
        $this->postJson('/api/__e2e/checkout/groups/invalid/quote', [])->assertStatus(409);
        $this->postJson('/api/__e2e/checkout/groups/invalid/invoices', [])->assertStatus(409);
        $this->getJson('/api/__e2e/checkout/invoices/invalid')->assertStatus(409);
        $this->postJson('/api/__e2e/checkout/invoices/invalid/initiate', [])->assertStatus(409);
        $this->postJson('/api/__e2e/checkout/invoices/invalid/expire-for-test', [])->assertStatus(409);
    }

    public function test_flag_alone_cannot_enable_fake_checkout_on_a_non_fixture_database(): void
    {
        config()->set('booking_test.enabled', true);
        config()->set('booking_test.gateway', 'fake');
        config()->set('booking_test.hold_minutes', 15);
        config()->set('booking_test.fixture_token', str_repeat('a', 64));
        config()->set('database.connections.mysql.database', 'landatrip_ci');
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        app(TestCheckout::class)->guard();
    }

    public function test_configured_e2e_name_cannot_spoof_the_connected_database(): void
    {
        if (config('database.connections.mysql.database') === 'landatrip_e2e') {
            $this->markTestSkipped('This spoof check runs against the backend CI database.');
        }
        config()->set('booking_test.enabled', true);
        config()->set('booking_test.gateway', 'fake');
        config()->set('booking_test.hold_minutes', 15);
        config()->set('booking_test.fixture_token', str_repeat('a', 64));
        config()->set('database.connections.mysql.database', 'landatrip_e2e');
        $this->assertFalse(app(TestCheckout::class)->available());
    }

    public function test_missing_gateway_or_fixture_marker_blocks_checkout(): void
    {
        config()->set('booking_test.enabled', true);
        config()->set('booking_test.hold_minutes', 15);
        config()->set('database.connections.mysql.database', 'landatrip_e2e');
        config()->set('booking_test.gateway', '');
        $this->assertFalse(app(TestCheckout::class)->available());
        config()->set('booking_test.gateway', 'fake');
        config()->set('booking_test.fixture_token', '');
        $this->assertFalse(app(TestCheckout::class)->available());
        config()->set('booking_test.fixture_token', str_repeat('z', 64));
        $this->assertFalse(app(TestCheckout::class)->available());
    }
}
