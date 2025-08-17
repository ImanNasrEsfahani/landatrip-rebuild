<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
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
                'language_id'     =>  1,
                'country_name'    =>  "Spain",
                'city_name'       =>  "barcelon"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "Turkey",
                'city_name'       =>  "Istanbul"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "Germany",
                'city_name'       =>  "Berlin"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "England",
                'city_name'       =>  "London"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "Italy",
                'city_name'       =>  "Milan"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "Canada",
                'city_name'       =>  "Toronto"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "USA",
                'city_name'       =>  "Los angles"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "UAE",
                'city_name'       =>  "Dubai"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "Armenia",
                'city_name'       =>  "Yerevan"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "Ukraine",
                'city_name'       =>  "Kiev"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "Iran",
                'city_name'       =>  "Kish"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "Iran",
                'city_name'       =>  "Varzaneh"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "Oman",
                'city_name'       =>  "Mascut"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "اسپانیا",
                'city_name'       =>  "بارسلونا"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "ترکیه",
                'city_name'       =>  "استانبول"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "آلمان",
                'city_name'       =>  "برلین"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "انگلستان",
                'city_name'       =>  "لندن"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "ایتالیا",
                'city_name'       =>  "میلان"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "کانادا",
                'city_name'       =>  "ترنتو"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "آمریکا",
                'city_name'       =>  "لوس آنجلس"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "امارات متحده عربی",
                'city_name'       =>  "دبی"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "ارمنستان",
                'city_name'       =>  "ایروان"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "اکراین",
                'city_name'       =>  "کیو"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "ایران",
                'city_name'       =>  "کیش"
            ],
            [
                'language_id'     =>  3,
                'country_name'    =>  "ایران",
                'city_name'       =>  "ورزنه"
            ],
            [
                'language_id'     =>  1,
                'country_name'    =>  "Iran",
                'city_name'       =>  "Abyaneh"
            ]
        ];

        Location::insert($items);
    }
}
