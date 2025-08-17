<?php

namespace App\Http\Resources;

use App\Enums\GenderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ConversationSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->profileImage()->first()) {
            $profileImage = $this->profileImage()->first()->url;
        } else {
            $profileImage = match ($this->sex?->value) {
                GenderStatusEnum::male => "default.png",
                GenderStatusEnum::female => "default.png",
                default => "male.png",
            };
        }
        $role = $this->roles()->pluck('name')->first();
        return [
            'value'         =>  $this->id,
            'label'   =>  $this->name,
            'role'          =>  $role,
            'id'            =>  $this->id,
            'profile'       =>  $this->profileImage ? Storage::url("/users/profile/" . $profileImage) : "",
            'isFixed'       =>  "true",
        ];
    }
}
