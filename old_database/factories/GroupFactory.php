<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\TourOperation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tourOperation = Group::factory()->makeOne();

        return [
            "title"                 =>  $this->faker->sentence,
            "slug"                  =>  $this->faker->slug,
            "tour_operation_id"     =>  $tourOperation->id,
            "public"                =>  $this->faker->randomElement([true, false])
        ];
    }
}
