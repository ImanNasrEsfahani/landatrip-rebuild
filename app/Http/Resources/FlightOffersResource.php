<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightOffersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "itineraries"     =>   FlightITDetailsResource::collection($this->resource["itineraries"]),
            "travelerPricings" =>  $this->resource["travelerPricings"],
            "price"            =>  $this->resource["price"]
        ];
    }
}
