<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;


/**
 * @property mixed $id
 * @property mixed $city_name
 * @property mixed $country_name
 */
class TeacherLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"           => $this->id,
            "city_name"    => $this->city_name,
            "country_name" => $this->country_name
        ];
    }
}
