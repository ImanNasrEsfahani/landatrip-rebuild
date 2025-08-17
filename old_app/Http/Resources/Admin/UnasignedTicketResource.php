<?php

namespace App\Http\Resources\Admin;

use App\Enums\GenderStatusEnum;
use App\Enums\TicketStatusEnum;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UnasignedTicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
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
            "id"                        =>  $this->id,
            "profile"                   =>  $profileImage,
            "user_slug"                 =>  $this->user()->first()->slug,
            "user_name"                 =>  $this->user()->first()->fname . " " . $this->user()->first()->lname,
            "subject"                   =>  $this->title,
            "message"                   =>  $this->message,
            "priority"                  =>  $this->priority->description,
            "created_at"                =>  Carbon::create($this->created_at)->diffForHumans()
        ];
    }
}
