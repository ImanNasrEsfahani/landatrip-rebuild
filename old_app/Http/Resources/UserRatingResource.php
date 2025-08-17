<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "user_id"  =>  $this->id,
            "fname"     =>  $this->fname,
            "lname"     =>  $this->lname,
            "profile"     =>  $this->profileImage()->first()->url,
            "status" => $this->userRated()->where("user_id", "=", auth()->user()->id)->first() ? "drag" : "undrag"
        ];
    }
}
