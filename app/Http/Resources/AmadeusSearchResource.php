<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AmadeusSearchResource extends JsonResource
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
            "name"     => $json["name"],
            "iataCode" => $json["iataCode"],
            "address"  => $json["address"]
        ];
    }
}
