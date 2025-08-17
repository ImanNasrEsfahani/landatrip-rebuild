<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TicketRecordsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if($this->user->profileImage()->first()) {
            $profileImage = $this->user->profileImage()->first()->url;
        } else {
            $profileImage = match ($this->sex->value) {
                GenderStatusEnum::male => "male.png",
                GenderStatusEnum::female => "female.png",
                default => "male.png",
            };
        };


        return [
            "ticket_title"  => $this->ticket->title,
            "name"          => $this->user->name,
            "profile"       => Storage::url("/users/profile/".$profileImage),
            "role_user"     => $this->user->roles[0]->display_name,
            "message"       => $this->message,
            "seen"          => $this->seen?->diffForHumans(),
            "created_at"    => $this->created_at->diffForHumans(),
        ];
    }
}
