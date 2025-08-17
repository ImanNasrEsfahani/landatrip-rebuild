<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserInfo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->profileImage()->first()) {
            $profileImage = $this->profileImage()->first()->url;
        } else {
            $profileImage = match ($this->sex->value) {
                GenderStatusEnum::male => "male.png",
                GenderStatusEnum::female => "female.png",
                default => "male.png",
            };
        };

        return [
            "fname"         => $this->fname,
            "lname"         => $this->lname,
            "slug"          => $this->slug,
            "profile_image" => Storage::url("/users/profile/" . $profileImage),
            "title"         => $this->title,
        ];
    }
}

