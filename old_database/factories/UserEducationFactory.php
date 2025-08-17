<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserEducation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class UserEducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$userObj = User::factory()->makeOne();

        $from = $this->faker->year;
        return [
            //"user_id"       =>  $userObj->id,
            "title"         =>  $this->faker->word(4),
            "university"    =>  $this->faker->word(4),
            "level"         =>  $this->faker->randomElement(['bachelor', 'master', 'PHD']),
            "from"          =>  $from,
            "to"            =>  $from + 3
        ];
    }
}
