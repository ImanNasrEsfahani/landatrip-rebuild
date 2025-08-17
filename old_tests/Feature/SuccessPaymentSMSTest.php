<?php

namespace Tests\Feature;

use App\Events\SuccessPaymentEvent;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SuccessPaymentSMSTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_event()
    {
        if(env("TEST_ENABLED")) {
            SuccessPaymentEvent::dispatch(Transaction::factory('OK')->makeOne());
        }
        $this->assertTrue(true);
    }
}
