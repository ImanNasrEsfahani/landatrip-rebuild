<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
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
                "name"   =>   "redTemplate",
                "url"    =>   "redTemplate.png"
            ],
            [
                "name"   =>   "blueTemplate",
                "url"    =>   "blueTemplate.png"
            ],
            [
                "name"   =>   "blackTemplate",
                "url"    =>   "blackTemplate.png"
            ],
        ];

                    foreach ($items as $certificate) {
                $certificateObj = new Certification($certificate);
                //$certificateObj->user()->associate(User::whereRoleIs('teacher')->inRandomOrder()->first());
                        $certificateObj->save();
            }
    }
}
