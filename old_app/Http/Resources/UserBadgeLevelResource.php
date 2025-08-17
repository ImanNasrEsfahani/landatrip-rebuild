<?php

namespace App\Http\Resources;

use App\Models\UserBadgeLevel;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserBadgeLevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {

        $progressbar=collect();
        foreach ($this->badge->badgeLevels as $badgeLevel){
            $progressbar->push(["min" => $badgeLevel->criterion_min]);
        }
        $progressbar = $progressbar->push(["min" => $this->badge->badgeLevels->last()->criterion_max])->pluck('min');
        return  [
            "progressbar" => $progressbar,
            "score"       => (int)(($this->score/$this->badgeLevel->criterion_max)*100),
            "image"       => Storage::url('badges/'.$this->badgeLevel->image ?? "default.png"),
            "criterion"   => $this->badge->name .' '. $this->badgeLevel->name
        ];
//        $userBadgeLevelObj = UserBadgeLevel::where("user_id", "=", auth()->user()->id)->where("badge_id", "=", $this->id)->first();
//        $min = 0;
//        foreach($this->badgeLevels()->get() as $badgeLevel) {
//            if($badgeLevel->criterion_min < $min) {
//                $min = $badgeLevel->criterion_min;
//            }
//        }
//
//        $max = 0;
//        foreach($this->badgeLevels()->get() as $badgeLevel) {
//            if($badgeLevel->criterion_max) {
//                if($badgeLevel->criterion_max > $max) {
//                    $max = $badgeLevel->criterion_max;
//                }
//            }
//        }

//        if($userBadgeLevelObj) {
//            return [
//                "name"      => $this->name,
//                "min"     => $min,
//                "max"     => $max,
//                "score"     => $userBadgeLevelObj ? $userBadgeLevelObj->score : 0,
//                "image"     => $userBadgeLevelObj->badgeLevel()->first()->image ?? "default.png",
//                "criterion" =>$userBadgeLevelObj->badgeLevel()->first()->criterion_max
//            ];
//        }

//        return [
//            "name"      => $this->name,
//            "score"     => $userBadgeLevelObj ? $userBadgeLevelObj->score : 0,
//            "image"     => $this->badgeLevels()->first()->image
//        ];
    }
}
