<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Language;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsSeeder extends Seeder
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
                'language_id'       =>  1,
                'title'             =>  "Business Analysis",
                'thumbnail_pic'     =>  [
                                            'url'           =>      'business-analysis.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'Business Analysis - Landa Trip'
                                        ]
            ],
            [
                'language_id'       =>  1,
                'title'             =>  "Digital Marketing",
                'thumbnail_pic'     =>  [
                                            'url'           =>      'digital-marketing.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'Digital Marketing - Landa Trip'
                                        ],
            ],
            [
                'language_id'       =>  1,
                'title'             =>  "Language Courses",
                'thumbnail_pic'     =>  [
                                            'url'           =>      'language-courses.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'Language Courses - Landa Trip'
                                        ],
            ],
            [
                'language_id'       =>  1,
                'title'             =>  "Leadership",
                'thumbnail_pic'     =>  [
                                            'url'           =>      'leadership.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'Leadership - Landa Trip'
                                        ],
            ],
            [
                'language_id'       =>  1,
                'title'             =>  "Management",
                'thumbnail_pic'     =>  [
                                            'url'           =>      'management.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'Management - Landa Trip'
                                        ],
            ],
            [
                'language_id'       =>  3,
                'title'             =>  "تحلیلگری کسب و کار",
                'thumbnail_pic'     =>  [
                                            'url'           =>      'business-analysis.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'دوره های تلحلیلگری اقتصادی  - لانداتریپ'
                                        ],
            ],
            [
                'language_id'       =>  3,
                'title'             =>  "بازاریابی دیجیتال",
                'thumbnail_pic'     =>  [
                                            'url'           =>      'digital-marketing.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'دوره های دیجیتال مارکتینگ  - لانداتریپ'
                                        ],
            ],
            [
                'language_id'       =>  3,
                'title'             =>  "دوره‌های زبان",
                'thumbnail_pic'     =>  [
                                            'url'           =>      'language-courses.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'دوره های زبان های انگلیسی و خارجی  - لانداتریپ'
                                        ],
            ],
            [
                'language_id'       =>  3,
                'title'             =>  "رهبری",
                'thumbnail_pic'     =>  [
                                            'url'           =>      'leadership.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'دوره های رهبری  - لانداتریپ'
                                        ],
            ],
            [
                'language_id'       =>  3,
                'title'             =>  "مدیریت",
                'thumbnail_pic'     =>  [
                                            'url'           =>      'management.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'دوره های مدیریت - لانداتریپ'
                                        ],
            ]
        ];

        foreach ($items as $item) {
            $skillObj = new Skill($item);
            unset($skillObj['thumbnail_pic'], $skillObj['header_pic']);
            $skillObj->withoutEvents(function () use ($skillObj) {
                $skillObj->slug = $skillObj::makeSlug($skillObj->title);
                $skillObj->save();
            });


            $imageObj = new Image($item['thumbnail_pic']);
            $skillObj->images()->save($imageObj);
        }
        //Skill::insert($items);
    }
}
