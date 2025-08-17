<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCouponResource extends JsonResource
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
            "code"        => $this->code,
            "description" => $this->description,
            "expire"      => $this->expire->format('Y/m/d') . ($this->expire->isFuture() ? " (" . $this->expire->diffForHumans() . ")" : ""),
            "status"      => $this->status?->description
        ];
    }
}
