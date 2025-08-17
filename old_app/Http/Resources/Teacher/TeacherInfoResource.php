<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property mixed $fname
 * @property mixed $lname
 * @property mixed $slug
 * @property mixed $title
 * @property mixed $location
 * @property mixed $email
 * @property mixed $sex
 * @property mixed $score
 */
class TeacherInfoResource extends JsonResource
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
        return [
            "firstName"       => $this->fname,
            "lastName"        => $this->lname,
            "slug"            => $this->slug,
            "score"           => $this->score,
            "email"           => $this->email,
            "title"           => $this->title,
            "location"        => $this->location,
            "profile_picture" => $this->profileImage?->url ?? "",
            "profile_alt"     => $this->profileImage?->alt ?? "",
            "USD"             => 10000,
            "EUR"             => 153,
            "CAD"             => 2023,
            "Rial"            => 25222,
        ];
    }
}
