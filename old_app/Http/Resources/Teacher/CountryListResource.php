<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @property mixed $name
 * @property mixed $code
 * @property mixed $phone
 * @property mixed $slug
 */
class CountryListResource extends JsonResource
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
            "name"  =>  $this->name,
            "slug"  =>  $this->slug,
            "code"  =>  $this->code,
            "phone" =>  $this->phone
        ];
    }
}
