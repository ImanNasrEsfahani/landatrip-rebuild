<?php

namespace Tests\Feature;

use App\Events\FailsPaymentEvent;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class FailsPaymentEventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_event()
    {
        if(env("TEST_ENABLED")) {
            FailsPaymentEvent::dispatch(Transaction::factory('NOK')->makeOne());
        }
        $this->assertTrue(true);
    }
}
