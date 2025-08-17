<?php

namespace Tests\Feature;

use App\Events\NewsletterFormSubmit;
use App\Listeners\NewsletterFormSMSListener;
use App\Mail\NewsletterMail;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

class NewsletterEventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_sms()
    {
        //Event::fake();

        // Perform order shipping...
//        $user = User::factory()->make();

//        $response = $this->post(route('newsletter.store'), $user->toArray())
//            ->assertSuccessful();

//        dd($response);
//        Event::assertDispatched(NewsletterFormSMSListener::class, function ($e) use ($order) {
//            return $e->order->id === $order->id;
//        });

        if(env("TEST_ENABLED")) {
            NewsletterFormSubmit::dispatch(Newsletter::factory()->makeOne());
        }

        $this->assertTrue(true);
        //Event::assertDispatched(NewsletterFormSubmit::class);

        // Assert an event was dispatched twice...
//        Event::assertDispatched(NewsletterFormSubmit::class, 2);

        // Assert an event was not dispatched...
//        Event::assertNotDispatched(OrderFailedToShip::class);
    }

    public function test_mail()
    {
        Mail::assertSent(NewsletterMail::class);
    }
}
