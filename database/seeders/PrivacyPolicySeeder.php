<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
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
                "title" => "Show Profile Image",
                "status" => [ 'Public' , 'Followers Only', 'Private' ]
            ],
            [
                "title" => "Show Groups",
                "status" => [ 'Public' , 'Followers Only', 'Private' ]
            ],
            [
                "title" => "Show Educational Background",
                "status" => [ 'Public' , 'Followers Only', 'Private' ]
            ],
            [
                "title" => "Show Work Experience",
                "status" => [ 'Public' , 'Followers Only', 'Private' ]
            ], [
                "title" => "Show Tour History",
                "status" => [ 'Public' , 'Followers Only', 'Private' ]
            ], [
                "title" => "Show Certificate",
                "status" => [ 'Public' , 'Followers Only', 'Private' ]
            ],
        ];
        foreach ($items as $item) {
            $privacyObj = new PrivacyPolicy($item);
            $privacyObj->saveQuietly();
        }
    }
}

