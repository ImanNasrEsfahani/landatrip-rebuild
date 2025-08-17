<?php

namespace Database\Factories;

use App\Models\TermAndCondition;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class TermAndConditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tourObj = Tour::factory()->makeOne();

        return [
            'tour_id'   =>  $tourObj->id,
            'question'  =>  $this->faker->sentence,
            'answer'    =>  $this->faker->sentences
        ];
    }
}
