<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $link
 * @property mixed $status
 */
class TeacherAgreementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray ($request)
    {
        return [
            "id"     => $this->id,
            "title"  => $this->title,
            "link"   => $this->link,
            "status" => ucfirst($this->pivot->status)
        ];
    }
}
