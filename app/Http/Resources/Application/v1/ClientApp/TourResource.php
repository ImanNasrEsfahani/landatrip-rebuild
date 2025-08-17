<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TourResource extends JsonResource
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
        $tour = $this->tour()->first();
        return [
            "title"                 => $this->title,
            "slug"                  => $tour->slug,
            "public"                => $this->public ? true : false,
            "max_capacity"          => $this->max_capacity,
            "reserved"              => $this->users()->count(),
            "end_registration_date" => $this->end_registration_date,
            "image"                 => $this->images()->count() > 0 ? Storage::url("/groups/headers/" . $this->images()->first()->url) : null,
            "location"              => $tour->city->name. " " . $tour->city->country->name,
            "discount"              => "50%"
        ];
    }
}
