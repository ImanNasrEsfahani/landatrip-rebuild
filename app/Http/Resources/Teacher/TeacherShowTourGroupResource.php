<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherShowTourGroupResource extends JsonResource
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
            "id"    =>  $this->id,
            "title" =>  $this->title,
            "location"  =>  $this->tour?->city?->name,
            "public"    =>  $this->public,
            "image"     =>  $this->thumbnailImage?->url,

        ];
    }
}
