<?php

namespace App\Http\Resources\Admin;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->profileImage) {
            $profileImage = $this->profileImage->url;
        } else {
            $profileImage = match ($this->sex->value) {
                GenderStatusEnum::male => "male.png",
                GenderStatusEnum::female => "female.png",
                default => "male.png",
            };
        };

        return [
            "firstName"       => $this->fname,
            "lastName"        => $this->lname,
            "slug"            => $this->slug,
            "email"           => $this->email,
            "title"           => $this->title,
            "location"           => $this->location,
            "profile_picture" => $profileImage,
            "profile_alt"     => $this->profileImage?->alt ?? "",
        ];
    }
}
