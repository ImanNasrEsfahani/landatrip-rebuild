<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserCommenterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->profileImage()->first()) {
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
            "profile_image" => Storage::url("/users/profile/".$profileImage)
        ];
    }
}
