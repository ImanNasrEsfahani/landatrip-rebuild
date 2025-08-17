<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponsResource extends JsonResource
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
            "code"             => $this->code,
            "occasion"         => $this->description,
            "expire"           => $this->expire->isFuture() ? $this->expire->diffForHumans() :  $this->expire->format('Y/m/d') ,
            "status"           => $this->status->description,
            "percent"          => $this->percent,
            "maximum_discount" => $this->maximum_discount
        ];
    }
}
