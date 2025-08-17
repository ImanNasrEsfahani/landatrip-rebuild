<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $json = json_decode($this->resource, true);
        return [
            "bookingRequirements" => $json["bookingRequirements"],
            "flightOffers"        => new FlightOffersResource($json["flightOffers"]["0"])
        ];
    }
}
