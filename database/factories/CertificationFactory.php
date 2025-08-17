<?php

namespace Database\Factories;

use App\Models\Certification;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CertificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tourObj = Tour::count() > 0 ? Tour::inRandomOrder()->first() : Tour::factory()->create();

        return [
            'tour_id'                   =>  $tourObj->id,
            'title'                     =>  $this->faker->title,
            'date_issue'                =>  $this->faker->date,
            'certificate_type'          =>  $this->faker->randomElement(["Presentation Certificate", "Attendance Certificate"]),
            'image'                     =>  $this->faker->image
        ];
    }
}
