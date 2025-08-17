<?php

namespace Database\Factories;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    use Sluggable;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'fname'             => $this->faker->firstName(),
            'lname'             => $this->faker->lastName(),
            'slug'              => $this->faker->slug(6),
            'title'             => $this->faker->jobTitle(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => Carbon::now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
            'location'          => $this->faker->country,
            'sex'               => $this->faker->randomElement([1, 2, 3]),
            'about_me'          => $this->faker->realText(150),
//            "twitter"           => $this->faker->url,
//            "instagram"         => $this->faker->url,
//            "facebook"          => $this->faker->url,
//            "linkedin"          => $this->faker->url,
            "suspended"         => false
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => ['fname', 'lname'],
                'updatable' => true
            ]
        ];
    }
}
