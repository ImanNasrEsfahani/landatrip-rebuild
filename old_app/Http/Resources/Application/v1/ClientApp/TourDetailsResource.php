<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use App\Models\TourComment;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TourDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $rates = 0;
        $comment_star = TourCommentResource::collection($this->tourComments()->get());
        foreach ($comment_star as $rate) {
            $rates += $rate["star"];
        }
        $group = $this->groups()->latest()->first();
//        dd($this->certificate()->count());
        return [
            "header_image"          => $this->headerImage()->count() > 0 ? Storage::url("courses/header/".$this->headerImage()->first()->url) : null,
            "location"              => $this->city()->count() > 0 ? $this->city->name . ", " . $this->city->country->name : null,
            "map"                   => $this->map,
            "title"                 => $this->title,
            "nights"                => $group->nights,
            "days"                  => $group->days,
            "short_summary"         => $this->short_summary,
            "tour_overview"         => $this->tour_overview,
            "skills"                => $this->skills,
            "min_capacity"          => $group->min_capacity,
            "max_capacity"          => $group->max_capacity,
            "accommodation"         => $this->accommodation,
            "transport"             => $group->transport,
            "gallery"               => $this->gallery()->count() > 0 ? TourGalleryResource::collection($this->gallery()->get()) : null,
            "teacher"               => new UserInfo($this->user()->first()),
            "rate"                  => "4",
//            "Certification"         => $this->certificate()->count() > 0 ? TourCertificationResource::collection($this->certificate()->get()) : null,
            "tourHighlights"        => $this->tourHighlights()->count() > 0 ? TourHighlightsIncludesExcludesResource::collection($this->tourHighlights()->get()) : null,
            "tourItineraries"       => $this->tourItineraries()->count() > 0 ? TourItinerariesResource::collection($this->tourItineraries()->get()) : null,
            "tourIncludes"          => $this->tourIncludes()->count() > 0 ? TourHighlightsIncludesExcludesResource::collection($this->tourIncludes()->get()) : null,
            "tourExcludes"          => $this->tourExcludes()->count() > 0 ? TourHighlightsIncludesExcludesResource::collection($this->tourExcludes()->get()) : null,
            "termAndCondition"      => $this->termAndCondition()->count() > 0 ? TourTermAndConditionResource::collection($this->termAndCondition()->get()) : null,
            "new_date"              => $this->groups()->count() > 0 ? TourGroupsResource::collection($this->groups()->get()) : null,
            "comment_number"        => $this->tourComments()->count(),
            "reviews_rate"          => $this->tourComments()->count() > 0 ? floor($rates / $this->tourComments()->count()) : 0,
            "comments"              => $this->tourComments()->count() > 0 ? TourCommentResource::collection($this->tourComments()->get()) : null
        ];
    }
}
