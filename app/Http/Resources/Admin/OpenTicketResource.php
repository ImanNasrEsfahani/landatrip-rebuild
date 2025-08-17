<?php

namespace App\Http\Resources\Admin;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OpenTicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        if($this->user()->first()->profileImage()->first()) {
            $profileImage = $this->user()->first()->profileImage()->first()->url;
        } else {
            $profileImage = match ($this->sex->value) {
                GenderStatusEnum::male => "male.png",
                GenderStatusEnum::female => "female.png",
                default => "male.png",
            };
        };

        return [
            "id"            =>  $this->id,
            "profile"       =>  $profileImage,
            "user_name"     =>  $this->user()->first()->fname . " " . $this->user()->first()->lname,
            "subject"       =>  $this->title,
            "status"        =>  $this->status->description,
            "priority"      =>  $this->priority->description
        ];
    }
}
