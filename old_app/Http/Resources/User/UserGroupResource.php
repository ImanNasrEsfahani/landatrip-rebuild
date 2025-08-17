<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $tour
 * @property mixed $start_date
 * @property mixed $status
 */
class UserGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "thumbnail"  => $this->thumbnailImage->url,
            "alt"        => $this->thumbnailImage->alt,
            "title"      => $this->title,
            "slug"       => $this->slug,
            "start_date" => $this->start_date_tour->format("Y-m-d"),
            "end_date"   => $this->end_date_tour->format("Y-m-d"),
            "status"     => $this->status->description
        ];
    }
}
