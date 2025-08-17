<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProfileSocialMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "title"     => $this->title,
            "icon_address"      => Storage::url('/website/social-media-icon/'. $this->path),
            "profile_address"   => $this->pivot->address
        ];
    }
}
