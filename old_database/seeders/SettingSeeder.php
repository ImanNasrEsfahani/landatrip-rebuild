<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
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
                "title"     =>  "invoice email"
            ],
            [
                "title"     =>  "newsletter email"
            ],
            [
                "title"     =>  "payment email"
            ],
            [
                "title"     =>  "create tour email"
            ],
            [
                "title"     =>  "create community email"
            ],
            [
                "title"     =>  "change password email"
            ],
            [
                "title"     =>  "create group email"
            ],
            [
                "title"     =>  "ticket email"
            ],
            [
                "title"     =>  "badge email"
            ],
            [
                "title"     =>  "tour email"
            ]
        ];

        foreach ($items as $item) {
            $settingObj = new Setting($item);
            $settingObj->saveQuietly();
        }
    }
}
