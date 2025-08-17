<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'url'           =>  $this->faker->url,
            'image_type'    =>  $this->faker->mimeType(),
            'alt'           =>  $this->faker->sentence(5),
        ];
    }
}
