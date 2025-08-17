<?php

namespace App\Http\Resources\User;

use App\Enums\GenderStatusEnum;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $fname
 * @property mixed $lname
 * @property mixed $slug
 * @property mixed $title
 * @property mixed $birthday
 * @property mixed $phone_number
 * @property mixed $email
 * @property mixed $sex
 * @property mixed $about_me
 * @property mixed $skills
 */
class UserContactInfoDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
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

        $country = City::where("id", "=", $this->location)->first();

        return [
            "fname"           => $this->fname,
            "lname"           => $this->lname,
            "profile_picture" => $profileImage,
            'slug'            => $this->slug,
            'title'           => $this->title,
            'birthday'        => $this->birthday,
            'phone_number'    => $this->phone_number,
            'country'         => $country ? $country->country->name : null,
            'city'            => $country ? $country->name : null,
            'email'           => $this->email,
            'sex'             => $this->sex,
            'about_me'        => $this->about_me,
            'skills'          => $this->skills
        ];
    }
}
