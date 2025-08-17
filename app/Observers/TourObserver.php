<?php

namespace App\Observers;

use App\Models\Tour;
use App\Services\SlugGeneratorService;

class TourObserver
{
    /**
     * Handle the Tour "created" event.
     *
     * @param Tour $tour
     * @return void
     */
    public function creating(Tour $tour)
    {
       $tour->slug = $tour::makeSlug($tour->title);
    }

    /**
     * Handle the Tour "created" event.
     *
     * @param Tour $tour
     * @return void
     */
    public function created(Tour $tour)
    {
        //
    }

    /**
     * Handle the Tour "updated" event.
     *
     * @param Tour $tour
     * @return void
     */
    public function updated(Tour $tour)
    {
        //
    }

    /**
     * Handle the Tour "deleted" event.
     *
     * @param Tour $tour
     * @return void
     */
    public function deleted(Tour $tour)
    {
        //
    }

    /**
     * Handle the Tour "restored" event.
     *
     * @param Tour $tour
     * @return void
     */
    public function restored(Tour $tour)
    {
        //
    }

    /**
     * Handle the Tour "force deleted" event.
     *
     * @param Tour $tour
     * @return void
     */
    public function forceDeleted(Tour $tour)
    {
        //
    }
}
