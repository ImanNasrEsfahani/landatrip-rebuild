<?php

namespace App\Http\Resources;

use Amadeus\Amadeus;
use App\Models\Airlines;
use Carbon\CarbonInterval;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FlightItinerariesResource extends JsonResource
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
        $duration = $this?->resource["duration"];
        $interval = CarbonInterval::fromString($duration);
        $formattedDuration = $interval->format('%H:%I');
        return [
            "airline"  => $airline,
            "image"    => Storage::url("/website/airlines/" . $airline?->image),
            "duration" => $formattedDuration,
            "segments" => new FlightSegmentsResource($this["segments"])
        ];
    }
}
