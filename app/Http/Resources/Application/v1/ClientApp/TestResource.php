<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // booked resource
        dd($this);

        return [

        ];
    }
}
