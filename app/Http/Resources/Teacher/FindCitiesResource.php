<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *@property mixed $id
 *@property mixed $name
 *@property mixed $slug
 */
class FindCitiesResource extends JsonResource
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
            "id"    =>  $this->id,
            "name"  =>  $this->name,
            "slug"  =>  $this->slug
        ];
    }
}
