<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserInfoFollowingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->followedUser->profileImage()->first()) {
            $profileImage = $this->followedUser->profileImage()->first()->url;
        } else {
            $profileImage = match ($this->followedUser->sex->value) {
                GenderStatusEnum::male => "male.png",
                GenderStatusEnum::female => "female.png",
                default => "male.png",
            };
        };

        return [
            "fname"         => $this->followedUser->fname,
            "lname"         => $this->followedUser->lname,
            "slug"          => $this->followedUser->slug,
            "profile_image" => Storage::url("/users/profile/" . $profileImage),
            "title"         => $this->followedUser->title,
        ];
    }
}
