<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


class PostsImagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return string
     */
    public function toArray($request)
    {
        return Storage::url("/posts/".$this->url);
    }
}
