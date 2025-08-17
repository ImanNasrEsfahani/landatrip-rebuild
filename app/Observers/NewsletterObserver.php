<?php

namespace App\Observers;

use App\Events\NewsletterFormSubmit;
use App\Models\Newsletter;

class NewsletterObserver
{
    /**
     * Handle the Newsletter "created" event.
     *
     * @param Newsletter $newsletter
     * @return void
     */
    public function created(Newsletter $newsletter)
    {
        //
    }

    /**
     * Handle the Newsletter "updated" event.
     *
     * @param Newsletter $newsletter
     * @return void
     */
    public function updated(Newsletter $newsletter)
    {
        //
    }

    /**
     * Handle the Newsletter "deleted" event.
     *
     * @param Newsletter $newsletter
     * @return void
     */
    public function deleted(Newsletter $newsletter)
    {
        //
    }

    /**
     * Handle the Newsletter "restored" event.
     *
     * @param Newsletter $newsletter
     * @return void
     */
    public function restored(Newsletter $newsletter)
    {
        //
    }

    /**
     * Handle the Newsletter "force deleted" event.
     *
     * @param Newsletter $newsletter
     * @return void
     */
    public function forceDeleted(Newsletter $newsletter)
    {
        //
    }
}
