<?php

namespace App\Http\Resources;

use Amadeus\Amadeus;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightSegmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $Jafar = [];
            foreach($this->resource as $resource) {
                array_push($Jafar,  new FlightBackResource($resource));
            }
            return $Jafar;
    }
}
