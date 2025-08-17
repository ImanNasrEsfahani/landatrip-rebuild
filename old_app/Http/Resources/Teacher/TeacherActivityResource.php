<?php

namespace App\Http\Resources\Teacher;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $countries = ["Iran", "USA", "Canada", "UAE", "Germany"];
        $randomKeyCountry = array_rand($countries);

        $os = ["Windows", "MacOS", "Iphone", "Android"];
        $randomKeyOS = array_rand($os);

        return [
            "title"     =>  $this->title,
            "ip"        =>  $this->ip,
//            "country"   =>  $this->country,
            "country"   =>  $countries[$randomKeyCountry],
//            "os"        =>  $this->os,
            "os"        =>  $os[$randomKeyOS],
            "created_at" => Carbon::parse($this->created_at)->format('Y/m/d')
        ];
    }
}
