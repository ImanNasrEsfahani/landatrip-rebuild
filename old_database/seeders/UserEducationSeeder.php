<?php

namespace Database\Seeders;

use App\Models\UserEducation;
use Faker\Factory;
use Faker\Guesser\Name;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $items = [
            [
                "user_id"       =>  2,
                "title"         =>  "Computer Science",
                "university"    =>  "University " . $faker->city,
                "level"         =>  $faker->randomElement(["Bachelor", "Master", "Doctorate"]),
                "from"          =>  $faker->year("now"),
                "to"            =>  $faker->year("now")
            ],
            [
                "user_id"       =>  3,
                "title"         =>  "Mathematical",
                "university"    =>  "University " . $faker->city,
                "level"         =>  $faker->randomElement(["Bachelor", "Master", "Doctorate"]),
                "from"          =>  $faker->year("now"),
                "to"            =>  $faker->year("now")
            ],
            [
                "user_id"       =>  4,
                "title"         =>  "Mechanical Engineer",
                "university"    =>  "University " . $faker->city,
                "level"         =>  $faker->randomElement(["Bachelor", "Master", "Doctorate"]),
                "from"          =>  $faker->year("now"),
                "to"            =>  $faker->year("now")
            ],
            [
                "user_id"       =>  5,
                "title"         =>  "Civil Engineer",
                "university"    =>  "University " . $faker->city,
                "level"         =>  $faker->randomElement(["Bachelor", "Master", "Doctorate"]),
                "from"          =>  $faker->year("now"),
                "to"            =>  $faker->year("now")
            ],
            [
                "user_id"       =>  2,
                "title"         =>  "Electrical Engineer",
                "university"    =>  "University " . $faker->city,
                "level"         =>  $faker->randomElement(["Bachelor", "Master", "Doctorate"]),
                "from"          =>  $faker->year("now"),
                "to"            =>  $faker->year("now")
            ]
        ];


        foreach ($items as $item) {
            $obj = new UserEducation($item);
            $obj->saveQuietly();
        }
    }
}
