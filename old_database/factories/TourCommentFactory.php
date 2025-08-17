<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourComment>
 */
class TourCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //$languageObj = Language::factory()->makeOne();
        //$tourObj = Tour::factory()->makeOne();
        //$userObj = User::factory()->makeOne();

        return [
            //'language_id'   =>  $languageObj->id,
            //'tour_id'       =>  $tourObj->language()->id,
            //'user_id'       =>  $userObj->id,
            'star'          =>  $this->faker->randomDigit(),
            'comment'       =>  $this->faker->realText
        ];
    }
}
