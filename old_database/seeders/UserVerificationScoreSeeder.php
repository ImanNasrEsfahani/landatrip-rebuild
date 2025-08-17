<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserVerificationScore;

class UserVerificationScoreSeeder extends Seeder
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
                "criteria"     =>  "User profile uploaded",
                "weight"     =>  15
            ],
            [
                "criteria"     =>  "Header Image uploaded",
                "weight"     =>  5
            ],
            [
                "criteria"     =>  "First name and Last name setted",
                "weight"     =>  15
            ],
            [
                "criteria"     =>  "Verification email address",
                "weight"     =>  10
            ],
            [
                "criteria"     =>  "Job criteria setted",
                "weight"     =>  5
            ],
            [
                "criteria"     =>  "Gender",
                "weight"     =>  5
            ],
            [
                "criteria"     =>  "About me",
                "weight"     =>  5
            ],
            [
                "criteria"     =>  "Passport Scan",
                "weight"     =>  10
            ],
            [
                "criteria"     =>  "Education Background",
                "weight"     =>  10
            ],
            [
                "criteria"     =>  "Work Experience",
                "weight"     =>  10
            ],
            [
                "criteria"     =>  "Social media",
                "weight"     =>  10
            ]
        ];

        UserVerificationScore::insert($items);
    }
}
