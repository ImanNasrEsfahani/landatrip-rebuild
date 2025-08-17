<?php

namespace App\Http\Resources\Admin;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminTicketRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->user->profileImage) {
            $profileImage = $this->user->profileImage->url;
        } else {
            $profileImage = match ($this->user->sex->value) {
                GenderStatusEnum::male => "male.png",
                GenderStatusEnum::female => "female.png",
                default => "male.png",
            };
        };


        return [
            "name"          => $this->user->name,
            "profile"       => $profileImage,
            "profile_alt"   => $this->user->profileImage ? $this->user->profileImage->alt : "",
            "role_user"     => $this->user->roles[0]->display_name,
            "message"       => $this->message,
            "seen"          => $this->seen?->diffForHumans(),
            "created_at"    => $this->created_at->diffForHumans(),
            "is_my_message" => $this->user->id === auth()->user()->id
        ];
    }

}
