<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
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
            "name"      => User::find($this->user_id)->name,
            "message"   => $this->message,
            "date"      => $this->created_at->diffForHumans(),
            "is_sender" => $this->user_id === auth()->user()->id ? true : false,
            "user_id"   => $this->user_id,
            "is_read"   => $this->is_read
        ];
    }
}
