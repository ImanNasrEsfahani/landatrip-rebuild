<?php

namespace App\Listeners;

use App\Events\FailsPaymentEvent;
use App\Mail\FailsPaymentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class FailsPaymentMailListener extends BaseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param FailsPaymentEvent $event
     *
     * @return void
     */
    public function handle(FailsPaymentEvent $event): void
    {
        foreach ([env('MAIL_RECIPIENT_1', null), env('MAIL_RECIPIENT_2', null), env('MAIL_RECIPIENT_3', null), $event->transaction->email] as $recipient) {
            if ($recipient) {
                Mail::to($recipient)->send(new FailsPaymentMail($event->transaction));
            }
        }
        info("FailsPaymentMailListener is fired for Email address: $recipient");
    }
}
