<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourCommentResource extends JsonResource
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
            "commenter"             => new UserCommenterResource($this->user()->first()),
            "comment"               => $this->comment,
            "star"                  => $this->star,
            "comment_likes_num"     => $this->tourCommentLikes()->count(),
            "comment_replies-num"   => $this->tourCommentReplies()->count(),
            "replies"               => TourCommentReplyResource::collection($this->tourCommentReplies()->get())
        ];
    }
}
