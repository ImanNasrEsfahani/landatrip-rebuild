<?php

namespace App\Listeners;

use App\Events\RegistrationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use IPPanel\Errors\Error;
use IPPanel\Errors\HttpException;

class RegistrationSMSListener extends BaseListener
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
     * @param RegistrationEvent $event
     *
     * @return void
     * @throws Error
     * @throws HttpException
     */
    public function handle(RegistrationEvent $event): void
    {
        $patternValues = [
            "lname" => $event->user->lname,
        ];
        if (strtolower(env('APP_ENV')) === 'production') {
            foreach ([env("SMS_RECIPIENT_1", null), env("SMS_RECIPIENT_2", null), env("SMS_RECIPIENT_3", null)] as $item) {
                if ($item) {
                    $this->FARAZAMAN_SMS_PANEL(env("FARAZAMAN_PATTERN_PAYMENT_REGISTRATION", null), $item, $patternValues);
                }
            }
        }
    }
}
