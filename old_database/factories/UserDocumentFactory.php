<?php

namespace Database\Factories;

use App\Enums\UserDocumentStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDocument>
 */
class UserDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $values = [];

        foreach (UserDocumentStatusEnum::cases() as $value) {
            $values[$value->name] = $value->value;
        }

        return [
            //'user_id',
            "title"     =>  $this->faker->sentence,
            "type"      =>  $this->faker->mimeType(),
            "status"    =>  $this->faker->randomElement(array_values($values))
        ];
    }
}
