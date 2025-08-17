<?php

namespace App\Observers;

use App\Models\City;
use App\Services\SlugGeneratorService;
use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CityObserver
{

    /**
     * Handle the Group "created" event.
     *
     * @param City $city
     *
     * @return void
     */
    public function creating(City $city)
    {
        $city->slug = $city::makeSlug($city->name);
    }
    /**
     * Handle the City "created" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function created(City $city)
    {
        //
    }

    /**
     * Handle the City "updated" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function updated(City $city)
    {
        //
    }

    /**
     * Handle the City "deleted" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function deleted(City $city)
    {
        //
    }

    /**
     * Handle the City "restored" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function restored(City $city)
    {
        //
    }

    /**
     * Handle the City "force deleted" event.
     *
     * @param  \App\Models\City  $city
     * @return void
     */
    public function forceDeleted(City $city)
    {
        //
    }
}
