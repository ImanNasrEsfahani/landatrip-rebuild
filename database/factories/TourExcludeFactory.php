<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\TourExclude;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class TourExcludeFactory extends Factory
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
            'title'     =>  $this->faker->sentence
        ];
    }
}
