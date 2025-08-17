<?php

namespace App\Observers;

use App\Models\Community;
use App\Services\SlugGeneratorService;

class CommunityObserver
{
    /**
     * Handle the Group "created" event.
     *
     * @param Community $community
     *
     * @return void
     */
    public function creating(Community $community)
    {
        $community->slug = $community::makeSlug($community->title);
    }

    /**
     * Handle the Community "created" event.
     *
     * @param  \App\Models\Community  $community
     * @return void
     */
    public function created(Community $community)
    {
        //
    }

    /**
     * Handle the Community "updated" event.
     *
     * @param  \App\Models\Community  $community
     * @return void
     */
    public function updated(Community $community)
    {
        //
    }

    /**
     * Handle the Community "deleted" event.
     *
     * @param  \App\Models\Community  $community
     * @return void
     */
    public function deleted(Community $community)
    {
        //
    }

    /**
     * Handle the Community "restored" event.
     *
     * @param  \App\Models\Community  $community
     * @return void
     */
    public function restored(Community $community)
    {
        //
    }

    /**
     * Handle the Community "force deleted" event.
     *
     * @param  \App\Models\Community  $community
     * @return void
     */
    public function forceDeleted(Community $community)
    {
        //
    }
}
