<?php

namespace App\Http\Resources;

use Amadeus\Amadeus;
use App\Models\Airlines;
use Carbon\CarbonInterval;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FlightITDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $name = "";
        foreach ($this["segments"] as $item) {
            if (isset($item["operating"])) {
                $name = $item["operating"]["carrierCode"];
            }
        }
        $airline = Airlines::where("icao", "=", $name)->first();
        return [
            "airline"  => $airline,
            "image"    => Storage::url("/website/airlines/" . $airline?->image),
            "segments" => new FlightSegmentsResource($this["segments"])
        ];
    }
}
