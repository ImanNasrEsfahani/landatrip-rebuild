<?php

namespace Database\Factories;

use App\Enums\UserCompanyStatusEnum;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;

/**
 * @extends Factory
 */
class UserCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$userObj = User::factory()->makeOne();

        $values = [];
        foreach (UserCompanyStatusEnum::cases() as $value) {
            $values[$value->name] = $value->value;
        }

        $from = $this->faker->year;
        return [
            //'user_id'       =>  $userObj->id,
            "company_name"  =>  $this->faker->company,
            "position"      =>  $this->faker->jobTitle,
            "from"          =>  $from,
            "to"            =>  (int)$from + 3,
            "status"        =>  $this->faker->randomElement(array_values($values))
        ];
    }
}
