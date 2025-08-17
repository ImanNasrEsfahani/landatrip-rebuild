<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
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
                "name"   => "USD",
                "symbol" => "$",
                "flag"   => "USD Flag"
            ],
            [
                "name"   => "Euro",
                "symbol" => "€",
                "flag"   => "Euro Flag"
            ],
            [
                "name"   => "CAD",
                "symbol" => "CAD",
                "flag"   => "CAD Flag"
            ],
            [
                "name"   => "Rials",
                "symbol" => "ریال",
                "flag"   => "Rials Flag"
            ]
        ];

        Currency::insert($items);
    }
}
