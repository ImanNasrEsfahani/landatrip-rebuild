<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserCertificate>
 */
class UserCertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userObj = User::count() > 0 ? User::inRandomOrder()->first() : User::factory()->create();
        $groupObj = Group::count() > 0 ? Group::inRandomOrder()->first() : Group::factory()->create();
        return [
            'user_id'    => $userObj->id,
            'group_id'   => $groupObj->id,
            'status'     => $this->faker->randomElement(["pending","completed","rejected"])
        ];
    }
}
