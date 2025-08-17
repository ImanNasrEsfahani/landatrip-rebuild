<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class UserListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $role = $this->user->roles()->pluck('name')->first();
        return [
            "id"                     => $this->user->id,
            "assign_name"            => $this->user->name,
            "assign_lname"           => $this->user->lname,
            "role"                   => $role,
            "assign_profile_picture" => Storage::url("/users/profile/" . $this->user->profileImage->url),
            "communication_id"       => $this->id,
            "time"                   => $this->records->last()?->created_at ? Carbon::create($this->records->last()?->created_at)->diffForHumans() : Carbon::now()->diffForHumans(),
            "sort"                   => $this->records->last()?->created_at ? $this->records->last()?->created_at : Carbon::now(),
        ];
    }
}
