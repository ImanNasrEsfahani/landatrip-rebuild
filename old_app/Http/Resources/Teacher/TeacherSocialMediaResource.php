<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $title
 * @property mixed $path
 * @property mixed $icon
 * @property mixed $pivot
 */
class TeacherSocialMediaResource extends JsonResource
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
            'title'     => $this->title,
            'path'      => $this->path,
            'icon'      => $this->icon,
            'address'   => $this->pivot->address,
        ];
    }
}
