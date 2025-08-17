<?php

namespace Database\Factories;

use App\Models\Community;
use App\Models\CommunityPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CommunityPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $communityObj = Community::factory()->makeOne();
        //$userObj = User::factory()->makeOne();

        return [
            'community_id'  =>  $communityObj->id,
            //'user_id'       =>  $userObj->id,
            "location"      =>  $this->faker->country,
            "title"         =>  $this->faker->words,
        ];
    }
}
