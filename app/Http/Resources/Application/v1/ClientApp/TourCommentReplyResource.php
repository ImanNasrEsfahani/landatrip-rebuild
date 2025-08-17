<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourCommentReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "reply_commenter"       => new UserCommenterResource($this->user()->first()),
            "likes"                 => $this->tourCommentReplyLikes()->count(),
            "reply"                 => $this->reply,
        ];
    }
}
