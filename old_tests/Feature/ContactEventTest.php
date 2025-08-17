<?php

namespace Tests\Feature;

use App\Events\ContactFormSubmit;
use App\Listeners\ContactFormSMSListener;
use App\Models\Contact;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ContactEventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_event()
    {
        //Event::fake();
        if(env("TEST_ENABLED")) {
            ContactFormSubmit::dispatch(Contact::factory()->make());
        }

        $this->assertTrue(true);
    }
}
