<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $company_name
 * @property mixed $position
 * @property mixed $status
 * @property mixed $from
 * @property mixed $to
 */
class TeacherWorkExperienceResource extends JsonResource
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
            "to"           => $this->to ?: 'Until Now',
            "status"       => $this->status->description
        ];
    }
}
