<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserCompany;
use App\Models\UserEducation;
use App\Models\UserPost;
use App\Models\UserView;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserViewSeeder extends Seeder
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
                "title"     =>  User::tableNameGetter()
            ],
            [
                "title"     =>  UserCompany::tableNameGetter()
            ],
            [
                "title"     =>  UserEducation::tableNameGetter()
            ],
            [
                "title"     =>  UserPost::tableNameGetter()
            ]
        ];

        UserView::insert($items);
    }
}
