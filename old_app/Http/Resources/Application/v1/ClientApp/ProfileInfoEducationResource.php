<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileInfoEducationResource extends JsonResource
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
            "title"         => $this->title,
            "university"    => $this->university,
            "level"         => $this->level,
            "from"          => $this->from,
            "to"            => $this->to === null ? "Until now" : $this->to,
        ];
    }
}
