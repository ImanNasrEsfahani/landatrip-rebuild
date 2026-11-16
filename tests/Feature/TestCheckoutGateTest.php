<?php

namespace Tests\Feature;

use App\Services\TestCheckout;
use Tests\TestCase;

class TestCheckoutGateTest extends TestCase
{
    public function test_fake_checkout_rejects_normal_application_configuration(): void
    {
        config()->set('booking_test.enabled', false);
        $this->postJson('/api/__e2e/checkout/callback', [
            'authority' => 'fake_'.str_repeat('a', 32), 'result' => 'success',
        ])->assertStatus(409);
    }

    public function test_flag_alone_cannot_enable_fake_checkout_on_a_non_fixture_database(): void
    {
        config()->set('booking_test.enabled', true);
        config()->set('booking_test.gateway', 'fake');
        config()->set('booking_test.hold_minutes', 15);
        config()->set('database.connections.mysql.database', 'landatrip_ci');
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        app(TestCheckout::class)->guard();
    }
}
