<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'          =>  $this->faker->name,
            'department'    =>  $this->faker->randomElement(['Language Department', 'Digital Marketing', 'Management', 'Business Analysis']),
            'title'         =>  $this->faker->jobTitle,
            'email'         =>  $this->faker->email,
            'phone'         =>  $this->faker->phoneNumber,
            'message'       =>  $this->faker->realText(150)
        ];
    }
}
