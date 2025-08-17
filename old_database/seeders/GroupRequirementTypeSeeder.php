<?php

namespace Database\Seeders;

use App\Models\GroupRequirementType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupRequirementTypeSeeder extends Seeder
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
                "title"     =>  "Documents"
            ],
            [
                "title"     =>  "Audition"
            ]
        ];

        foreach ($items as $item) {
            $groupRequirementTypeObj = new GroupRequirementType($item);
            $groupRequirementTypeObj->save();
        }
    }
}
