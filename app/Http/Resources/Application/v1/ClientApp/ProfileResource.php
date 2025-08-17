<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use App\Enums\GenderStatusEnum;
use App\Models\City;
use App\Models\Following;
use Illuminate\Support\Facades\Storage;
use App\Models\UserSocialMedia;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
        if ($this->profileImage()->first()) {
            $profileImage = $this->profileImage()->first()->url;
        } else {
            $profileImage = match ($this->sex->value) {
                GenderStatusEnum::male => "male.png",
                GenderStatusEnum::female => "female.png",
                default => "male.png",
            };
        };

        if ($this->headerImage()->first()) {
            $headerImage = $this->headerImage()->first()?->url;
        } else {
            $headerImage =  "default.png";
        };

        $country = City::where("id", "=", $this->location)->first();

        return [
            "fname"         => $this->fname,
            "lname"         => $this->lname,
            "slug"          => $this->slug,
            "profile_image" => Storage::url("/users/profile/" . $profileImage),
            "title"         => $this->title,
            "sex"           => $this->sex->description,
            "location"      => $country->name.', '.$country->country->name,
            "social_media"  => ProfileSocialMediaResource::collection($this->socialMedia()->get()),
            "headerImage"   => Storage::url("/users/header/" . $headerImage),
            "followers"     => $this->followers()->count(),
            "following"     => $this->following()->count(),
            "contribute"    => $this->userPosts()->count(),
            "is_following"  => Following::where("follower_id", "=", auth()->user()->id)->where("followed_id", "=", $this->id)->count() === 1 ? true : false,
            "is_followed"   => Following::where("follower_id", "=", $this->id)->where("followed_id", "=", auth()->user()->id)->count() === 1 ? true : false
        ];
    }
}
