<?php

namespace App\Http\Resources\User;

use App\Models\PrivacyPolicy;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserPrivacyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $userPrivacy = $this->userPrivacy()->where("user_id", "=", auth()->user()->id)->first();
        $active = 0;
        if($userPrivacy) {
            $active = $userPrivacy->status;
        }


        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'status'     => $this->status,
            'active'     => $active
        ];
    }
}
