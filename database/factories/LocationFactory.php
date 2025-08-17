<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languageObj = Language::factory()->makeOne();

        return [
            'language_id'       =>  $languageObj->id,
            'country_name'      =>  $this->faker->country,
            'city_name'         =>  $this->faker->city
        ];
    }
}
