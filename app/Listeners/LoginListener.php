<?php

namespace App\Listeners;

use App\Models\Activity;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Stevebauman\Location\Facades\Location;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\App;

class LoginListener
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
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        $activity = new Activity([
            "title"     =>  "Successful Login",
            "ip"        =>  request()->ip(),
            "country"   =>  "Unknown",
            "os"        =>  "Unknown"
        ]);
        $activity->user()->associate($event->user);
        $activity->save();

        Log::info("activity listener: " . 'http://ip-api.com/json/' . request()->ip() .'?callback=' .  route("update.activity.ip.response", $activity->id));
        Http::timeout(10)->get('http://ip-api.com/json/' . request()->ip() .'?callback=' .  route("update.activity.ip.response", $activity->id));
    }
}
