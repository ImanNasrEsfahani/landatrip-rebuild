<?php

namespace App\Http\Resources\Admin;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "title"                 =>  $this->title,
//            "assigned_agent"        =>  $this->assignedUser()->fname . " " . $this->assignedUser()->lname,
            "priority"              =>  $this->priority->description,
            "status"                =>  $this->status->description,
        ];
    }
}
