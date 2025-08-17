<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class InvoiceDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $invoiceObj = Invoice::factory()->makeOne();
        $tourObj = Tour::factory()->makeOne();

        return [
            'invoice_id'    =>  $invoiceObj->id,
            'tour_id'       =>  $tourObj->id,
            'count'         =>  $this->faker->randomDigit(),
            'price'         =>  $this->faker->numberBetween(10, 800)
        ];
    }
}
