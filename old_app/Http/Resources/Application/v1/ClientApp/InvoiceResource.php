<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'created_at' => $this->created_at->format('Y/m/d') . " (" . $this->created_at->diffForHumans() . ")",
            'expired_at' => $this->expire->format('Y/m/d') . " (" . $this->expire->diffForHumans() . ")",
            'total'      => $this->subtotal . " " . $this->currency->symbol,
            'status'     => $this->status?->description
        ];
    }
}
