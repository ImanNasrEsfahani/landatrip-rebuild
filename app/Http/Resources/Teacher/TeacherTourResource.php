<?php

namespace App\Http\Resources\Teacher;

use App\Enums\GroupStatusEnum;
use App\Models\City;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;


/**
 * @property mixed $title
 * @property mixed $location
 * @property mixed $days
 * @property mixed $nights
 * @property mixed $status
 */
class TeacherTourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $country = City::where("id", "=", $this->location_id)->first();

        return [
            "id"              => $this->id,
            "title"           => $this->title,
            "location"        => $country->name,
            "total_group"     => $this->groups()->count(),
            "confirmed_group" => $this->groups()->where("status", "=", GroupStatusEnum::booking)->count(),
            "status"          => $this->status->description,
        ];
    }
}
