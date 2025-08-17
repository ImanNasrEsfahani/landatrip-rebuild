<?php

namespace App\Listeners;

use App\Events\SuccessPaymentEvent;
use App\Mail\SuccessPaymentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SuccessPaymentMailListener extends BaseListener
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
     * @param SuccessPaymentEvent $event
     *
     * @return void
     */
    public function handle(SuccessPaymentEvent $event): void
    {
        foreach ([env('MAIL_RECIPIENT_1', null), env('MAIL_RECIPIENT_2', null), env('MAIL_RECIPIENT_3', null), $event->transaction->email] as $recipient) {
            if ($recipient) {
                Mail::to($recipient)->send(new SuccessPaymentMail($event->transaction));
            }
        }
        info("SuccessPaymentMailListener is fired for Email address: $recipient");
    }
}
