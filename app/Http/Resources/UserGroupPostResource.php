<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserGroupPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request):array
    {
        return [
            'group_id'              => $this->group_id,
            'user_id'               => $this->user_id,
            "user_name"             => $this->user()->first()->name,
            "user_profile_image"    => $this->user()->first()->profileImage()->first()->url,
            'message'               => $this->message,
            "created_at"            => Carbon::create($this->created_at)->diffForHumans()
        ];
    }
}
