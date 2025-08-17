<?php

namespace App\Http\Resources;

use App\Enums\GroupUserStatusEnum;
use App\Models\GroupUser;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TourCardsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            "title"                 => $this->title,
            "slug"                  => $this->slug,
            "start_date"            => $this->start_date_tour->format('d M'),
            "public"                => $this->public ? "Public" : "privet",
            "thumbnailImage"        => Storage::url("groups/thumbnails/". $this->thumbnailImage->url),
            "max_capacity"          => $this->max_capacity,
            "end_registration_date" => $this->end_registration_date->diffInDays(),
            "booked_user_count"     => GroupUser::where("group_id", "=", $this->id)->where("status", "=", GroupUserStatusEnum::booked)->count(),
            "reserved_user_count"   => GroupUser::where("group_id", "=", $this->id)->where("status", "=", GroupUserStatusEnum::reservation)->count(),
            "users_profileImage"    => UserProfileImageResource::collection($this->users),
            "status"                => $this->status->description,
            "price"                 => "450$"

        ];
    }
}
