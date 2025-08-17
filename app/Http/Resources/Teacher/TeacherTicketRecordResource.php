<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherTicketRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name"          => $this->user->name,
            "profile"       => $this->user->profileImage->url,
            "profile_alt"   => $this->user->profileImage->alt,
            "role_user"     => $this->user->roles[0]->display_name,
            "message"       => $this->message,
            "seen"          => $this->seen?->diffForHumans(),
            "created_at"    => $this->created_at->diffForHumans(),
            "is_my_message" => $this->user->id === auth()->user()->id
        ];
    }
}
