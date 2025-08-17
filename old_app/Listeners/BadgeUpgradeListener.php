<?php

namespace App\Listeners;

use App\Mail\BadgeUpgradeMail;
use App\Models\Badge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BadgeUpgradeListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->userBadgeLevel->user->email) {
            Mail::to($event->userBadgeLevel->user->email)->send(new BadgeUpgradeMail($event->userBadgeLevel));
        }
        info("BadgeUpgradeMailListener is fired for Email address: $event->userBadgeLevel->user ");
    }
}
