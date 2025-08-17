<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentReplyResource extends JsonResource
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
            "id" => $this->id,
            "message"    => $this->reply,
            "likes"      => $this->userPostCommentReplyLikes()->count(),
            "commenter"  => new UserCommenterResource($this->user()->first()),
            "is_liked" => $this->userPostCommentReplyLikes()->where("user_id","=",auth()->user()->id)->count() ===1 ? true:false

        ];
    }
}
