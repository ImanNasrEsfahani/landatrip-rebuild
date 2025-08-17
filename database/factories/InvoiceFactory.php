<?php

namespace Database\Factories;

use App\Enums\InvoiceStatusEnum;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$userObj = User::factory()->create();
        $couponObj = Coupon::factory()->makeOne();

        $total = $this->faker->numberBetween(20,600);
        $discount = $this->faker->numberBetween(0,19);

        $expireDate = $this->faker->dateTimeBetween(Carbon::now()->subMonth(), Carbon::now()->addMonth())->format('Y-m-d');

        return [
            //'id'       =>  $id,
            'title'         =>  $this->faker->sentence(5),
            //'user_id'       =>  $userObj->id,
            'coupon_id'     =>  $couponObj->id,
            'currency_id'   =>  $this->faker->randomElement(Currency::all())->id,
            'total'         =>  $total,
            'discount'      =>  $discount,
            'tax'           =>  ($total - $discount) * 0.15,
            'subtotal'      =>  ($total - $discount) + ($total - $discount) * 0.15,
            'expire'        =>  $expireDate,
            'status'        =>  Carbon::create($expireDate)->isPast() ? InvoiceStatusEnum::expired : $this->faker->randomElement([InvoiceStatusEnum::paid, InvoiceStatusEnum::canceled, InvoiceStatusEnum::pending])
        ];
    }
}
