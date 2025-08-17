<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Resources\Json\JsonResource;

class TourCategoryCollection extends JsonResource
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
            "info"      =>  $this->info,
            "data"      =>  $this->data
        ];
    }
}
