<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'         =>  $this->title,
            'slug'          =>  $this->slug,
            'group_size'    =>  $this->group_size,
            'days'          =>  $this->days,
            'nights'        =>  $this->nights,
        ];
    }
}
