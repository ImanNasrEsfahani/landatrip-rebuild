<?php

namespace App\Http\Resources;

use Amadeus\Amadeus;
use App\Models\Airlines;
use Illuminate\Http\Resources\Json\JsonResource;

class AmadeusResource extends JsonResource
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
            "details"               => $json,
            "oneWay"                => $json["oneWay"],
            "numberOfBookableSeats" => $json["numberOfBookableSeats"],
            "price"                 => new FlightPriceResource($json["price"]),
            "itineraries"           => FlightItinerariesResource::collection($json["itineraries"]),
            "travelerPricings"      => $json["travelerPricings"],
            "cabin"                 => $json["travelerPricings"][0]["fareDetailsBySegment"][0]["cabin"],
        ];
    }
}
