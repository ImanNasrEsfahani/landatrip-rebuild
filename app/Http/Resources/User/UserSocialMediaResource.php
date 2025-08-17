<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

///**
// * @property mixed $twitter
// * @property mixed $instagram
// * @property mixed $facebook
// * @property mixed $linkedin
// */
class UserSocialMediaResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id"          =>ucfirst($this->pivot->user_id),
            "title"       => ucfirst($this->pivot->social_media_id),
            "address"        => ucfirst($this->pivot->address),
        ];
    }
}
