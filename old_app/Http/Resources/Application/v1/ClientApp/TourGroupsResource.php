<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourGroupsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            "start_date_tour"   => $this->start_date_tour->diffForHumans(),
            "days_left"         => $this->end_registration_date->diffForHumans(),
            "starting_location" => $this->starting_location,
            "price"             => '100$',
            "status"            => $this->status->description,
        ];
    }
}
