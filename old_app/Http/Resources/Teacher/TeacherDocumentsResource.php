<?php

namespace App\Http\Resources\Teacher;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property mixed $id
 * @property mixed $type
 * @property mixed $slug
 * @property mixed $title
 * @property mixed $status
 * @property mixed $created_at

 */
class TeacherDocumentsResource extends JsonResource
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
            "id"         => $this->id,
            "title"      => $this->title,
            "type"       => $this->type,
            "status"     => $this->status,
            "created_at" => Carbon::parse($this->created_at)->format('Y/m/d')
        ];
    }
}
