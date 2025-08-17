<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $company_name
 * @property mixed $position
 * @property mixed $from
 * @property mixed $to
 */
class UserWorkExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray ($request): array
    {
        return [
            "id"           => $this->id,
            "company_name" => $this->company_name,
            "position"     => $this->position,
            "from"         => $this->from,
            "to"           => $this->to ?: null,
            "status"       => $this->status->description
        ];
    }
}
