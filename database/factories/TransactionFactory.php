<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(string $status = null): array
    {
        $invoiceObj = Invoice::factory()->create();

        return [
            'invoice_id'        =>  $invoiceObj->id,
            'authority'         =>  $this->faker->uuid,
            'status'            =>  $status
        ];
    }
}
