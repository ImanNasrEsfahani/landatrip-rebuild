<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $title
 * @property mixed $capacity
 * @property mixed $status
 */
class TeacherGroupResource extends JsonResource
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
            "title" => $this->title,
            "capacity" => $this->capacity,
            "status" => $this->status,
            "thumbnail" => $this->thumbnailImage()->url,
            "booked"  => $this->users()->count(),
            "lastMessage" => $this->groupPosts()->latest()->first() ? $this->groupPosts()->latest()->first()->message : ""

        ];
    }
}
