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
        return [
            "id"              => $this->id,
            "title"           => $this->title,
            "location"        => $this->city?->name,
            "total_group"     => $this->groups()->count(),
            "confirmed_group" => $this->groups()->where("status", "=", GroupStatusEnum::registration)->count(),
            "status"          => $this->status->description,
        ];
    }
}
