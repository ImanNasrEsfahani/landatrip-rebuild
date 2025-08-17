<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PostDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            "user"          => new  UserCommenterResource($this->user),
            "post_id"       => $this->id,
            "title"         => $this->title,
            "location"      => $this->location,
            "type"          => $this->images()->count() > 1 ? "multi" : "single",
            "image"         => PostsImagesResource::collection($this->images()->get()),
            "likes"         => $this->userPostLikes()->get()->count(),
            "comment_count" => $this->userPostComments()->count(),
            "active"        => array_rand([true, false]),
            "created_at"    => Carbon::create($this->created_at)->diffForHumans(),
            "is_liked"      => $this->userPostLikes()->where("user_id", "=", auth()->user()->id)->count() === 1 ? true : false,
            "is_saved"      => $this->usersPostSaved()->where("user_id", "=", auth()->user()->id)->count() === 1 ? true : false,
            "comments"      => PostCommentsResource::collection($this->userPostComments()->get()),
            "post_url"      => route("api.app.v1.post_detail",["post" => $this->id])
        ];
    }
}
