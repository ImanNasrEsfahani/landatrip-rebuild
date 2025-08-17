<?php

namespace App\Http\Resources\User;

use App\Models\ConversationRecord;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Query\Builder;

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
        if ($this->assignBy->id === auth()->user()->id) {
            $role = $this->user->roles()->pluck('name')->first();
            $unread = ConversationRecord::withoutEvents(function () {
                return ConversationRecord::where("conversation_id", "=", $this->id)->where("user_id", "<>", auth()->user()->id)->where("seen", "=", null)->count();
            });
            return [
                "id"                     => $this->user->id,
                "assign_name"            => $this->user->name,
                "assign_lname"           => $this->user->lname,
                "role"                   => $role,
                "assign_profile_picture" => Storage::url("/users/profile/" . $this->user->profileImage->url),
                "communication_id"       => $this->id,
                "time"                   => $this->updated_at->diffForHumans(),
                "sort"                   => $this->updated_at,
                "has_unread"             => $unread > 0 ? true : false,
                "unread_count"           => $unread
            ];
        } else {
            $role = $this->assignBy->roles()->pluck('name')->first();
            $unread = ConversationRecord::withoutEvents(function () {
                return ConversationRecord::where("conversation_id", "=", $this->id)->where("user_id", "<>", auth()->user()->id)->where("seen", "=", null)->count();
            });
            return [
                "id"                     => $this->assignBy->id,
                "assign_name"            => $this->assignBy->name,
                "assign_lname"           => $this->assignBy->lname,
                "role"                   => $role,
                "assign_profile_picture" => Storage::url("/users/profile/" . $this->assignBy->profileImage->url),
                "communication_id"       => $this->id,
                "time"                   => $this->updated_at->diffForHumans(),
                "sort"                   => $this->updated_at,
                "has_unread"             => $unread > 0 ? true : false,
                "unread_count"           => $unread
            ];
        }

    }
}
