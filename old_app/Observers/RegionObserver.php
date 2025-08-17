<?php

namespace App\Observers;

use App\Models\Region;
use App\Services\SlugGeneratorService;

class RegionObserver
{
    /**
     * Handle the Group "created" event.
     *
     * @param Region $region
     *
     * @return void
     */
    public function creating(Region $region)
    {
        $region->slug = $region::makeSlug($region->name);
    }

    /**
     * Handle the Region "created" event.
     *
     * @param  \App\Models\Region  $region
     * @return void
     */
    public function created(Region $region)
    {
        //
    }

    /**
     * Handle the Region "updated" event.
     *
     * @param  \App\Models\Region  $region
     * @return void
     */
    public function updated(Region $region)
    {
        //
    }

    /**
     * Handle the Region "deleted" event.
     *
     * @param  \App\Models\Region  $region
     * @return void
     */
    public function deleted(Region $region)
    {
        //
    }

    /**
     * Handle the Region "restored" event.
     *
     * @param  \App\Models\Region  $region
     * @return void
     */
    public function restored(Region $region)
    {
        //
    }

    /**
     * Handle the Region "force deleted" event.
     *
     * @param  \App\Models\Region  $region
     * @return void
     */
    public function forceDeleted(Region $region)
    {
        //
    }
}
