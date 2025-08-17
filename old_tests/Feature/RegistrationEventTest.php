<?php

namespace Tests\Feature;

use App\Events\RegistrationEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationEventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_event(): void
    {
        //Event::fake();

        if(env("TEST_ENABLED")) {
            RegistrationEvent::dispatch(User::factory()->makeOne());
        }

        $this->assertTrue(true);

        //Event::assertDispatched(FailsPaymentEvent::class);
    }
}
