<?php

namespace App\Http\Resources;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


class BookingProcessUserSearchResource extends JsonResource
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
            "fname"   => $this->fname,
            "lname"   => $this->lname,
            "slug"    => $this->slug,
            "picture" => Storage::url("/users/profile/" . $profileImage)
            ,
        ];
    }
}
