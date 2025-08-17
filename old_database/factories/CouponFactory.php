<?php

namespace Database\Factories;

use App\Enums\CouponStatusEnum;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        $userObj = User::factory()->makeOne();

        return [
//            "user_id"       =>  $userObj->id,
            "code"          =>  $this->faker->randomKey . $this->faker->randomDigitNotNull . $this->faker->randomKey . $this->faker->randomDigitNotNull,
            "description"   =>  $this->faker->sentence,
            "expire"        =>  $this->faker->date,
            "status"        =>  CouponStatusEnum::active
        ];
    }
}
