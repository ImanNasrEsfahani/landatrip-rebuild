<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class UserPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$userObj = User::inRandomOrder()->first();

        return [
            //'user_id'   =>  $userObj->id,
            'title'     =>  $this->faker->sentence,
            'location'  =>  $this->faker->country,
        ];
    }
}
