<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ExploreResource extends JsonResource
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
            "id"       => $this->id,
            "url"      => Storage::url("/posts/" . $this->images()->first()->url),
        ];
    }
}
