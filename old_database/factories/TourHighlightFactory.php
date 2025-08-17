<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourHighlight>
 */
class TourHighlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $tourObj = Tour::factory()->makeOne();

        return [
            'tour_id'   =>  $tourObj->id,
            'title'     =>  $this->faker->sentence(5)
        ];
    }
}
