<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class SkillFactory extends Factory
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
            'language_id'   => $languageObj->id,
            'title'         => $this->faker->sentence(5),
            'slug'          => $this->faker->slug
        ];
    }
}
