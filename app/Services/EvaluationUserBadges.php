<?php

namespace App\Services;

use App\Enums\GroupUserStatusEnum;
use App\Models\Badge;
use App\Models\GroupUser;
use App\Models\Location;
use App\Models\User;
use App\Models\City;

class EvaluationUserBadges
{
    /**
     * @var User $user
     */
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * range finder for badge level
     * @param $badgeLevelCollect
     * @param $score
     * @return mixed
     */
    private function rangeFinder($badgeLevelCollect, $score)
    {
        $min = 0;
        foreach($badgeLevelCollect as $badgeLevel) {
            if($badgeLevel->criterion_min < $min) {
                $min = $badgeLevel->criterion_min;
            }
        }

        if($score < $min) {
            return $badgeLevelCollect->last();
        }


        $max = 0;
        foreach($badgeLevelCollect as $badgeLevel) {
            if($badgeLevel->criterion_max) {
                if($badgeLevel->criterion_max >= $max) {
                    $max = $badgeLevel->criterion_max;
                }
            }
        }

        if($score >= $max) {
            return $badgeLevelCollect->first();
        }

        return collect($badgeLevelCollect)->first(function ($value, $key) use ($score) {
            $min = $value->criterion_min ? $value->criterion_min : 0;

            if($value->criterion_max) {
                if($score >= $min && $score < $value->criterion_max) return $value;
            } else {
                if($score >= $min) return $value;
            }
        });
    }

    /**
     * @return array|null
     */
    public function explorer()
    {

        $badgeObj = Badge::where("name", "=", "Explorer")->first();
        $score = GroupUser::where("user_id", "=", $this->user->id)->where("status", "=", GroupUserStatusEnum::completed)->count();

//        print_r("name: " . $this->user->fname . " " . $this->user->lname . " score: " . $score . "\r\n");
        if($badgeObj) {
//            print_r("Badge: " . $badgeObj->name . "\r\n");
            $level = $this->rangeFinder($badgeObj->badgeLevels()->get(), $score);
//            print_r("Badge Level: " . $level->name . "\r\n");
//            print_r("\r\n");

            return [
                "score"             =>  $score,
                "badge_id"          =>  $badgeObj->id,
                "badge_level_id"    =>  $level->id
            ];
        }
        return null;
    }

    /**
     * @return array|null
     */
    public function amiable()
    {
        $badgeObj = Badge::where("name", "=", "Amiable")->first();
        $score = $this->user->userRated()->count() ?? 0;
        if($badgeObj) {
            $level = $this->rangeFinder($badgeObj->badgeLevels()->get(), $score);
            return [
                "score"             => $score,
                "badge_id"          =>  $badgeObj->id,
                "badge_level_id"    =>  $level->id
            ];
        }
        return null;
    }

    /**
     * @return array|null
     */
    public function photoGrapher()
    {
        $badgeObj = Badge::where("name", "=", "Photo Grapher")->first();

        $score = $this->user->userPosts()->count() ?? 0;

        if($badgeObj) {
            $level = $this->rangeFinder($badgeObj->badgeLevels()->get(), $score);
            return [
                "score" => $score,
                "badge_id"    =>  $badgeObj->id,
                "badge_level_id"    =>  $level->id
            ];
        }
        return null;
    }

    /**
     * @return array|null
     */
    public function nomad()
    {
        $badgeObj = Badge::where("name", "=", "Nomad")->first();

        $groups = $this->user->groups()->with("tour")->withPivotValue("status", GroupUserStatusEnum::completed)->get();
        $filtered = $groups->groupBy("tour.city_id")->keys();
        $score = $filtered->map(function ($value, $key) {
            return City::find($value)->country_name;
        })->unique()->count();

        if($badgeObj) {
            $level = $this->rangeFinder($badgeObj->badgeLevels()->get(), $score);
            return [
                "score" => $score,
                "badge_id"    =>  $badgeObj->id,
                "badge_level_id"    =>  $level->id
            ];
        }
        return null;
    }

    /**
     * @return array|null
     */
    public function influencer()
    {
        $badgeObj = Badge::where("name", "=", "Influencer")->first();

        $score = $this->user->followers()->count() ?? 0;

        if($badgeObj) {
            $level = $this->rangeFinder($badgeObj->badgeLevels()->get(), $score);
            return [
                "score" => $score,
                "badge_id"    =>  $badgeObj->id,
                "badge_level_id"    =>  $level->id
            ];
        }
        return null;
    }

//    /**
//     * @return array|null
//     */
//    public function contentCreator()
//    {
//        $badgeObj = Badge::where("name", "=", "Content Creator")->first();
//
//        $score = $this->user->followers()->count() ?? 0;
//
//
//        print_r("Content Creator " . $this->user->name . " score " . $score . "\n");
//        if($badgeObj) {
//            $level = $this->rangeFinder($badgeObj->badgeLevels()->get(), $score);
//            return [
//                "score" => $score,
//                "badge_id"    =>  $badgeObj->id,
//                "badge_level_id"    =>  $level->id
//            ];
//        }
//        return null;
//    }
}
