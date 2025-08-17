<?php

namespace App\Http\Resources\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDocumentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray ($request): array
    {
        return [
            "id"         => $this->id,
            "title"      => $this->title,
            "type"       => $this->type,
            "status"     => $this->status->description,
            "created_at" => Carbon::parse($this->created_at)->format('Y/m/d')
        ];
    }
}
