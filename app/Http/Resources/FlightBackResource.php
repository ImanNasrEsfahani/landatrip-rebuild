<?php

namespace App\Http\Resources;

use App\Models\Airlines;
use App\Models\Airport;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class FlightBackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $departure = [
            "city" => Airport::where("iata_code","=",$this?->resource["departure"]["iataCode"])->first()?->name,
            "at"       => Carbon::parse($this?->resource["departure"]["at"])->format('H:i')
        ];
        $arrival = [
            "city" => Airport::where("iata_code","=",$this?->resource["arrival"]["iataCode"])->first()?->name,
            "at"       => Carbon::parse($this?->resource["arrival"]["at"])->format('H:i')
        ];
        $name = "";
        if (isset($this?->resource["operating"])) {
            $name = $this?->resource["operating"]["carrierCode"];
        }
        $airline = Airlines::where("icao", "=", $name)->first();
        return [
            "departure"     => $departure,
            "arrival"       => $arrival,
            "numberOfStops" => $this->resource["numberOfStops"],
            "carrierCode"   => $airline
        ];
    }
}
