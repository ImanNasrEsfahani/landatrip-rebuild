<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "comment_message" => $this->comment,
            "comment_likes_num" => $this->userPostCommentLikes()->count(),
            "comment_replies-num" => $this->userPostCommentReplies()->count(),
            "commenter" => new UserCommenterResource($this->user()->first()),
            "is_liked"=>$this->userPostCommentLikes()->where("user_id","=",auth()->user()->id)->count() === 1 ? true:false ,
            "replies" => PostCommentReplyResource::collection($this->userPostCommentReplies()->get()),
        ];
    }
}
