<?php

namespace App\Listeners;

use App\Events\FailsPaymentEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FailsPaymentSMSListener extends BaseListener
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
     * @return void
     */
    public function handle(FailsPaymentEvent $event)
    {
        //

        $patternValues = [
            "lname"         => $event->transaction->invoice->user->lname ?? "User",
            "amount"        => $event->transaction->invoice->subtotal,
            "authority"     => $event->transaction->invoice->id,
        ];

        if(strtolower(env('APP_ENV')) === 'production') {
            foreach ([env("SMS_RECIPIENT_1", null), env("SMS_RECIPIENT_2", null), env("SMS_RECIPIENT_3", null)] as $item) {
                if ($item) {
                    $this->FARAZAMAN_SMS_PANEL(env("FARAZAMAN_PATTERN_PAYMENT_FAILS", null), $item, $patternValues);
                }
            }
        }
    }
}
