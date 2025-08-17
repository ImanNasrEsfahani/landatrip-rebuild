<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CommunicationRecordsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->assignBy->id === auth()->user()->id) {
            $role = $this->user->roles()->pluck('name')->first();
            return [
                "name"      =>  $this->user->name,
                "role"      =>  $role,
                "image"     =>  Storage::url("/users/profile/" . $this->user->profileImage->url),
                "communication_id" => $this->id,
                "data"      =>  MessageResource::collection($this->records)
            ];
        }else{
            $role = $this->assignBy->roles()->pluck('name')->first();
            return [
                "name"      =>  $this->assignBy->name,
                "role"      =>  $role,
                "image"     =>  Storage::url("/users/profile/" . $this->assignBy->profileImage->url),
                "communication_id" => $this->id,
                "data"      =>  MessageResource::collection($this->records)
            ];
        }

    }
}
