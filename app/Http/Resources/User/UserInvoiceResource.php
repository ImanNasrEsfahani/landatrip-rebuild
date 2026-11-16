<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $created_at
 * @property mixed $subtotal
 * @property mixed $expire
 * @property mixed $title
 */
class UserInvoiceResource extends JsonResource
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
            'id'         => $this->id,
            'title'      => $this->title,
            'created_at' => $this->created_at->format('Y/m/d') . " (" . $this->created_at->diffForHumans() . ")",
            'expired_at' => $this->expire->format('Y/m/d') . " (" . $this->expire->diffForHumans() . ")",
            'total'      => $this->total . " " . ($this->currency?->symbol ?? ''),
            'status'     => $this->status?->description
        ];
    }
}
