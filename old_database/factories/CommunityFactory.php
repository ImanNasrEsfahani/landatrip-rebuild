<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$userObj = User::factory()->makeOne();

        return [
            //'user_id'       =>  $userObj->id,
            "title"         =>  $this->faker->words(3, true),
            "slug"          =>  $this->faker->slug,
            "about_us"      =>  $this->faker->sentences(4, true),
            "admin_only"    =>  $this->faker->randomElement([true, false])
        ];
    }
}
