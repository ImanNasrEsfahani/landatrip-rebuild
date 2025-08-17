<?php

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingProcessApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        dd($this->users->count());
        return [
            "tour_title"      => $this->tour->title,
            "group_title"     => $this->title,
            "destination"     => $this->tour->city()->first()->name . ", " . $this->tour->city->country()->first()->name,
            "public"          => $this->public ? "Public" : "privet",
            "start_date_tour" => $this->start_date_tour->format('l، j F Y'),
            "end_date_tour"   => $this->end_date_tour->format('l، j F Y'),
            "days"            => $this->days,
            "nights"          => $this->nights,
            "capacity"        => $this->max_capacity - $this->users->count(),
        ];
    }
}
