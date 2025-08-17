<?php

namespace Database\Factories;

use App\Enums\TicketPriorityStatusEnum;
use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;

/**
 * @extends Factory
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //"user_id",
            //"assigned_agent_id",
            "title"         =>  $this->faker->sentence(6),
            "priority"     =>  $this->faker->randomElement(TicketPriorityStatusEnum::getValues()),
            "rate"          => $this->faker->randomNumber(1),
            "feedback"      =>  $this->faker->sentence,
            "status"       =>  $this->faker->randomElement(TicketStatusEnum::getValues())
        ];
    }
}
