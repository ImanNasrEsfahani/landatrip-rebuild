<?php

namespace App\Http\Resources\User;

use App\Enums\GenderStatusEnum;
use Composer\XdebugHandler\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTicketRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
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
            "is_my_message" => $this->user->id === auth()->user()->id,
            "image"         => $this->chatImage
        ];
    }
}
