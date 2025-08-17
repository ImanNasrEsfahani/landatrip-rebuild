<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $title
 * @property mixed $university
 * @property mixed $level
 * @property mixed $from
 * @property mixed $to
 * @property mixed $status
 */
class UserEducationalBackgroundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id"         => $this->id,
            "title"      => $this->title,
            "university" => $this->university,
            "level"      => $this->level,
            "from"       => $this->from,
            "to"         => $this->to,
            "status"     => $this->status->description
        ];
    }
}
