<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\BadgeLevel;
use App\Models\User;
use App\Models\UserBadgeLevel;
use App\Services\EvaluationUserBadges;
use Illuminate\Database\Seeder;

class BadgeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                "name" => "Explorer",
                "Levels" => [
                    [
                        "name" => "Novice",
                        "image" => "default.png",
                        "criterion_min"     =>  0,
                        "criterion_max"     =>  2
                    ],
                    [
                        "name" => "Bronze",
                        "image" => "explorer-bronze.png",
                        "criterion_min"     =>  2,
                        "criterion_max"     =>  5
                    ],
                    [
                        "name" => "Silver",
                        "image" => "explorer-silver.png",
                        "criterion_min"     =>  5,
                        "criterion_max"     =>  10
                    ],
                    [
                        "name" => "Golden",
                        "image" => "explorer-golden.png",
                        "criterion_min"     =>  10,
                        "criterion_max"     =>  PHP_INT_MAX
                    ],



                ]
            ],
            [
                "name" => "Amiable",
                "Levels" => [
                    [
                        "name" => "Novice",
                        "image" => "default.png",
                        "criterion_min"     =>  0,
                        "criterion_max"     =>  2
                    ],
                    [
                        "name" => "Bronze",
                        "image" => "amiable-bronze.png",
                        "criterion_min"     =>  2,
                        "criterion_max"     =>  4
                    ],
                    [
                    "name" => "Silver",
                    "image" => "amiable-silver.png",
                    "criterion_min"     =>  4,
                    "criterion_max"     =>  6
                    ],
                    [
                        "name" => "Golden",
                        "image" => "amiable-golden.png",
                        "criterion_min"     =>  6,
                        "criterion_max"     =>  PHP_INT_MAX
                    ],


                ]
            ],
            [
                "name" => "Photo Grapher",
                "Levels" => [
                    [
                        "name" => "Novice",
                        "image" => "default.png",
                        "criterion_min"     =>  0,
                        "criterion_max"     =>  2
                    ],
                    [
                        "name" => "Bronze",
                        "image" => "photographer-bronze.png",
                        "criterion_min"     =>  2,
                        "criterion_max"     =>  4
                    ],
                    [
                        "name" => "Silver",
                        "image" => "photographer-silver.png",
                        "criterion_min"     =>  4,
                        "criterion_max"     =>  6
                    ],
                    [
                        "name" => "Golden",
                        "image" => "photographer-golden.png",
                        "criterion_min"     =>  6,
                        "criterion_max"     =>  PHP_INT_MAX
                    ],


                ]
            ],
            [
                "name" => "Nomad",
                "Levels" => [
                    [
                        "name" => "Novice",
                        "image" => "default.png",
                        "criterion_min"     =>  0,
                        "criterion_max"     =>  2
                    ],
                    [
                        "name" => "Bronze",
                        "image" => "nomad-bronze.png",
                        "criterion_min"     =>  2,
                        "criterion_max"     =>  5
                    ],
                    [
                        "name" => "Silver",
                        "image" => "nomad-silver.png",
                        "criterion_min"     =>  5,
                        "criterion_max"     =>  10
                    ],
                    [
                        "name" => "Golden",
                        "image" => "nomad-golden.png",
                        "criterion_min"     =>  10,
                        "criterion_max"     =>  PHP_INT_MAX
                    ],


                ]
            ],
            [
                "name" => "Influencer",
                "Levels" => [
                    [
                        "name" => "Novice",
                        "image" => "default.png",
                        "criterion_min"     =>  0,
                        "criterion_max"     =>  100
                    ],
                    [
                        "name" => "Bronze",
                        "image" => "influencer-bronze.png",
                        "criterion_min"     =>  100,
                        "criterion_max"     =>  200
                    ],
                    [
                        "name" => "Silver",
                        "image" => "influencer-silver.png",
                        "criterion_min"     =>  200,
                        "criterion_max"     =>  300
                    ],
                    [
                        "name" => "Golden",
                        "image" => "influencer-golden.png",
                        "criterion_min"     =>  300,
                        "criterion_max"     =>  PHP_INT_MAX
                    ],


                ]
            ],
//            [
//                "name" => "Content Creator",
//                "Levels" => [
//                    [
//                        "name" => "Golden",
//                        "image" => "content-golden.png",
//                        "criterion_min"     =>  500,
//                        "criterion_max"     =>  null
//                    ],
//                    [
//                        "name" => "Silver",
//                        "image" => "content-silver.png",
//                        "criterion_min"     =>  100,
//                        "criterion_max"     =>  500
//                    ],
//                    [
//                        "name" => "Bronze",
//                        "image" => "content-bronze.png",
//                        "criterion_min"     =>  0,
//                        "criterion_max"     =>  100
//                    ]
//                ]
//            ]
        ];

        foreach ($items as $item) {
            $badgeObj = new Badge($item);
            unset($badgeObj["Levels"]);
            $badgeObj->saveQuietly();

            foreach ($item["Levels"] as $level) {
                $badgeLevelObj = new BadgeLevel($level);
                $badgeLevelObj->badge()->associate($badgeObj);
                $badgeLevelObj->saveQuietly();
            }
        }

        foreach (User::all() as $user) {
            $evaluationUserBadgeObj = new EvaluationUserBadges($user);

            $userBadgeLevelExplorerObj = new UserBadgeLevel($evaluationUserBadgeObj->explorer());
            $userBadgeLevelExplorerObj->user()->associate($user);
            $userBadgeLevelExplorerObj->saveQuietly();

            $userBadgeLevelAmiableObj = new UserBadgeLevel($evaluationUserBadgeObj->amiable());
            $userBadgeLevelAmiableObj->user()->associate($user);
            $userBadgeLevelAmiableObj->saveQuietly();

            $userBadgeLevelNostalgicObj = new UserBadgeLevel($evaluationUserBadgeObj->photoGrapher());
            $userBadgeLevelNostalgicObj->user()->associate($user);
            $userBadgeLevelNostalgicObj->saveQuietly();

            $userBadgeLevelNomadObj = new UserBadgeLevel($evaluationUserBadgeObj->nomad());
            $userBadgeLevelNomadObj->user()->associate($user);
            $userBadgeLevelNomadObj->saveQuietly();

            $userBadgeLevelInfluencerObj = new UserBadgeLevel($evaluationUserBadgeObj->influencer());
            $userBadgeLevelInfluencerObj->user()->associate($user);
            $userBadgeLevelInfluencerObj->saveQuietly();

//            $userBadgeLevelContentCreatorObj = new UserBadgeLevel($evaluationUserBadgeObj->contentCreator());
//            $userBadgeLevelContentCreatorObj->user()->associate($user);
//            $userBadgeLevelContentCreatorObj->saveQuietly();
        }
    }
}
