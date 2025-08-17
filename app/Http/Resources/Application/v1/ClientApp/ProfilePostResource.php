<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilePostResource extends JsonResource
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
            'post_id'   => $this->id,
            'title'    => $this->title,
            'location' => $this->location,
            "type"     => $this->images()->count() > 1 ? "multi" : "single",
            'images'   => PostsImagesResource::collection($this->images()->get()),
            'likes'    => $this->userPostLikes()->get()->count(),
            "is_liked" => $this->userPostLikes()->where("user_id", "=", auth()->user()->id)->count() === 1 ? true : false,
            "is_saved" => $this->usersPostSaved()->where("user_id", "=", auth()->user()->id)->count() === 1 ? true : false,
            "post_url" => route("api.app.v1.post_detail",["post" => $this->id])
        ];
    }
}

