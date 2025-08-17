<?php

namespace Database\Seeders;

use App\Enums\CouponStatusEnum;
use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                "code"              =>  "NEWYEAR",
                "description"       =>  "New year coupon",
                "expire"            =>  Carbon::parse('2023-10-12'),
                "percent"           =>  30,
                "maximum_discount"  =>  80,
            ],
            [
                "code"              =>  "TOURISMDAY",
                "description"       =>  "Toursim Day",
                "expire"            =>  Carbon::parse('2023-09-27'),
                "percent"           =>  20,
                "maximum_discount"  =>  70,
            ],
            [
                "code"              =>  "CHINANEWYEAR",
                "description"       =>  "China new year",
                "expire"            =>  Carbon::parse('2023-01-25'),
                "percent"           =>  35,
                "maximum_discount"  =>  78,
            ],
            [
                "code"              =>  "MANAGERDAY",
                "description"       =>  "Management day",
                "expire"            =>  Carbon::parse('2022-01-21'),
                "percent"           =>  66,
                "maximum_discount"  =>  20,
            ],
            [
                "code"              =>  "EASTER",
                "description"       =>  "Easter day",
                "expire"            =>  Carbon::parse('2022-06-21'),
                "percent"           =>  50,
                "maximum_discount"  =>  77,
            ],
            [
                "code"              =>  "GOODFRIDAY",
                "description"       =>  "Good Friday",
                "expire"            =>  Carbon::parse('2024-04-21'),
                "percent"           =>  10,
                "maximum_discount"  =>  30,
            ]
        ];

        foreach ($items as $item) {
            $couponObj = new Coupon($item);
            if($couponObj->expire->isPast()) $couponObj->status = CouponStatusEnum::expired;
            $couponObj->saveQuietly();

            $randUsers = User::whereHasRole('user')->inRandomOrder()->limit(random_int(9,User::count()))->get();
            foreach ($randUsers as $randUser) {
                $couponObj->users()->save($randUser);
            }
        }
    }
}
