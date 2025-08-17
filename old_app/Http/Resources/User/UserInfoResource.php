<?php

namespace App\Http\Resources\User;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
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
            "user_id"         => $this->id,
            "firstName"       => $this->fname,
            "lastName"        => $this->lname,
            "slug"            => $this->slug,
            "score"            => $this->score,
            "profile_picture" => $profileImage,
            "profile_alt"     => $this->profileImage?->alt ?? "",
            "USD"             => 10,
            "EUR"             => 15,
            "CAD"             => 20,
            "Rial"            => 25,
        ];
    }
}
