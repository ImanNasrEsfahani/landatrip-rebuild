<?php

namespace App\Http\Resources\User;

use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $time = $this?->records()->latest()->limit(1)->first()?->created_at;
        if ($this->assignBy->id === auth()->user()->id){
            $role = $this->user->roles()->pluck('name')->first();
            return [
                "assign_name"           => $this->user->name,
                "assign_lname"           => $this->user->lname,
                "role"                   => $role,
                "assign_profile_picture" => Storage::url("/users/profile/" . $this->user->profileImage->url),
                "communication_id"       => $this->id,
                "time"                   => Carbon::create($this->records->last()?->created_at)->diffForHumans(),
                "sort"                   => $this->records->last()?->created_at,
            ];
        }else{
            $role = $this->assignBy->roles()->pluck('name')->first();
            return [
                "assign_name"           => $this->assignBy->name,
                "assign_lname"           => $this->assignBy->lname,
                "role"                   => $role,
                "assign_profile_picture" => Storage::url("/users/profile/" . $this->assignBy->profileImage->url),
                "communication_id"       => $this->id,
                "time"                   => Carbon::create($this->records->last()?->created_at)->diffForHumans(),
                "sort"                   => $this->records->last()?->created_at
            ];
        }

    }
}
