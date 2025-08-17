<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            "id"            => $this->id,
            "title"         => $this->title,
            "priority"      => $this->priority->description,
            "status"        => $this->status->description,
            "rate"          => $this->rete,
            "created_at"    => Carbon::create($this->created_at)->diffForHumans()
        ];
    }
}
