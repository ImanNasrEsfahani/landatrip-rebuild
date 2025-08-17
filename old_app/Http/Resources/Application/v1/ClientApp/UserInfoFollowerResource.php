<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserInfoFollowerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->followerUser->profileImage()->first()) {
            $profileImage = $this->followerUser->profileImage()->first()->url;
        } else {
            $profileImage = match ($this->followerUser->sex->value) {
                GenderStatusEnum::male => "male.png",
                GenderStatusEnum::female => "female.png",
                default => "male.png",
            };
        };

        return [
            "fname"         => $this->followerUser->fname,
            "lname"         => $this->followerUser->lname,
            "slug"          => $this->followerUser->slug,
            "profile_image" => Storage::url("/users/profile/" . $profileImage),
            "title"         => $this->followerUser->title,
        ];
    }
}
