<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\GroupPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class GroupPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $groupObj = Group::inRandomOrder()->get()->first();
        $userObj = User::inRandomOrder()->get()->first();

        return [
            'group_id'      =>  $groupObj->id,
            'user_id'       =>  $userObj->id,
            'message'       =>  $this->faker->sentence
        ];
    }
}
