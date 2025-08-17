<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Invoice;
use App\Models\User;
use App\Models\UserCompany;
use App\Models\UserDocument;
use App\Models\UserEducation;
use App\Models\UserPost;
use App\Models\UserPostComment;
use App\Models\UserPostCommentLike;
use App\Models\UserPostCommentReply;
use App\Models\UserPostCommentReplyLikes;
use App\Models\UserPostLike;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
                'header_pic'        => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'     => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'             => "Landa Trip",
                'lname'             => "admin",
                'title'             => "Landa Trip Support",
                'slug'              => 'landa-trip',
                'is_stuff'          => true,
                'email'             => "admin@landatrip.com",
                'email_verified_at' => Carbon::Now(),
                "password"          => bcrypt("landatripadmin"),
                'location'          => "Canada",
                'sex'               => 3,
                'about_me'          => "",
                'twitter'           => "https://twitter.com",
                'instagram'         => "https://instagram.com",
                'facebook'          => "https://facebook.com",
                'linkedin'          => "https://linkedin.com",
                "profile"           => [
                    'url'        => 'admin.png',
                    'image_type' => 'profile',
                    'alt'        => 'admin of Landa Trip'
                ],
                "user_education"    => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2025",
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => null
                    ]
                ],
                "skill"             => [],
                "user_post"         => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"      => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null,
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents"    => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"              => "manager"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Ali",
                'lname'          => "moHamMadI",
                'title'          => "Investor",
                'is_stuff'       => false,
                'email'          => "ali.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Iran",
                'sex'            => 1,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'ali_123.png',
                    'image_type' => 'profile',
                    'alt'        => 'ali 123'
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "manager"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Sam",
                'lname'          => "shariat",
                'title'          => "Web developer",
                'is_stuff'       => false,
                'email'          => "sam.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Iran",
                'sex'            => 1,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'sam.321.png',
                    'image_type' => 'profile',
                    'alt'        => 'sam 123'
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "admin"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "sara",
                'lname'          => "esmaili",
                'title'          => "designer",
                'is_stuff'       => false,
                'email'          => "sara.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Iran",
                'sex'            => 2,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'sara.987.png',
                    'image_type' => 'profile',
                    'alt'        => 'sara 123'
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "admin"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Parsa",
                'lname'          => "Parsi",
                'title'          => "web developer",
                'is_stuff'       => false,
                'email'          => "parsa.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Iran",
                'sex'            => 1,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'parsa.321.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "admin"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Soheil",
                'lname'          => "Parsi",
                'title'          => "Accelerator",
                'is_stuff'       => false,
                'email'          => "Soheil.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Iran",
                'sex'            => 1,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'soheil_123.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "teacher"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Melika",
                'lname'          => "Hosseini",
                'title'          => "Human resource Manager",
                'is_stuff'       => false,
                'email'          => "Melika.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Turkey",
                'sex'            => 2,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'melika.987.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "teacher"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Maryam",
                'lname'          => "Sadeghi",
                'title'          => "Influencer",
                'is_stuff'       => false,
                'email'          => "Maryam.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "UAE",
                'sex'            => 2,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'maryam.987.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "teacher"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Mohammad",
                'lname'          => "Salehi",
                'title'          => "Investor",
                'is_stuff'       => false,
                'email'          => "Mohammad.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Iran",
                'sex'            => 1,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'mohammad.salehi.321.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "user"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Mehdi",
                'lname'          => "Rahimi",
                'title'          => "Investor and Coach",
                'is_stuff'       => false,
                'email'          => "Mehdi.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Iran",
                'sex'            => 1,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'mehdi_123.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "user"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Leila",
                'lname'          => "Jafari",
                'title'          => "Photographer",
                'is_stuff'       => false,
                'email'          => "Leila.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Armenia",
                'sex'            => 2,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'leila.987.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "user"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Reza",
                'lname'          => "Bagheri",
                'title'          => "Coach and Manager",
                'is_stuff'       => false,
                'email'          => "Reza.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Iran",
                'sex'            => 1,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'reza.bagheri.321.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "user"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Roham",
                'lname'          => "Alizadeh",
                'title'          => "Influencer",
                'is_stuff'       => false,
                'email'          => "Roham.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Turkey",
                'sex'            => 1,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'roham.alizadeh.321.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "user"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Ava",
                'lname'          => "Yousefi",
                'title'          => "Music composer",
                'is_stuff'       => false,
                'email'          => "Ava.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "UAE",
                'sex'            => 2,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'ava.987.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "user"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Parham",
                'lname'          => "Taheri",
                'title'          => "Accountant",
                'is_stuff'       => false,
                'email'          => "Parham.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Iran",
                'sex'            => 1,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'parham.taheri.321.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "user"
            ],
            [
                'header_pic'     => [
                    'url'        => 'Landa-trip-header.png',
                    'image_type' => 'header',
                    'alt'        => ' - Landa Trip'
                ],
                'thumbnail_pic'  => [
                    'url'        => '',
                    'image_type' => 'thumbnail',
                    'alt'        => ' - Landa Trip'
                ],
                'fname'          => "Zeinab",
                'lname'          => "Yousefi",
                'title'          => "Real state Agent",
                'is_stuff'       => false,
                'email'          => "Zeinab.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password"       => bcrypt("landatriptest123"),
                'location'       => "Iraq",
                'sex'            => 2,
                'about_me'       => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                'twitter'        => "https://twitter.com",
                'instagram'      => "https://instagram.com",
                'facebook'       => "https://facebook.com",
                'linkedin'       => "https://linkedin.com",
                "profile"        => [
                    'url'        => 'zeinab.987.png',
                    'image_type' => 'profile',
                    'alt'        => ''
                ],
                "user_education" => [
                    [
                        "title"      => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level"      => "Bachelor",
                        "from"       => "2007",
                        "to"         => "2011"
                    ],
                    [
                        "title"      => "Regional Planning",
                        "university" => "Tehran University",
                        "level"      => "Master",
                        "from"       => "2012",
                        "to"         => "2015"
                    ]
                ],
                "skill"          => [],
                "user_post"      => [
                    "title"    => "",
                    "location" => ""
                ],
                "user_company"   => [
                    [
                        "company_name" => "Landa Trip",
                        "position"     => "Founder",
                        "from"         => "2021",
                        "to"           => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position"     => "Web developer",
                        "from"         => "2019",
                        "to"           => "2022"
                    ]
                ],
                "user_documents" => [
                    [
                        "title" => "Driver Licence",
                        "type"  => "pdf",
                        "file"  => "driver-licence.pdf"
                    ],
                    [
                        "title" => "ID Card",
                        "type"  => "jpg",
                        "file"  => "id-card.jpg"
                    ]
                ],
                "role"           => "user"
            ]/*,
            [
                'fname'         =>  "",
                'lname'         =>  "",
                'is_stuff'      =>  false,
                'email'         =>  ".test@gmail.com",
                 'email_verified_at' => Carbon::Now(),
                "password"      =>  bcrypt("landatriptest123"),
                "profile"       =>  [
                                        'url'           =>      '',
                                        'image_type'    =>      'profile',
                                        'alt'           =>      ''
                                    ],
                "user_education"    => [
                    [
                        "title"         => "Urban Planning and Designing",
                        "university"    => "Shiraz University",
                        "level"         => "Bachelor",
                        "from"          => "2007",
                        "to"            => "2011"
                    ],
                    [
                        "title"         => "Regional Planning",
                        "university"    => "Tehran University",
                        "level"         => "Master",
                        "from"          => "2012",
                        "to"            => "2015"
                    ]
                ],
                "skill"             => [],
                "user_post"         => [
                    "title"         => "",
                    "location"      => ""
                ],
                "user_company"      =>  [
                    [
                        "company_name"  => "Landa Trip",
                        "position"      => "Founder",
                        "from"          => "2021",
                        "to"            => "now"
                    ],
                    [
                        "company_name"  => "Melale",
                        "position"      => "Web developer",
                        "from"          => "2019",
                        "to"            => "2022"
                    ],
                    "user_documents"   =>  [],
                    "role"           => "user"
                ]
            ]*/
        ];

        foreach ($items as $item) {

            $userObj = new User($item);
            unset($userObj["profile"], $userObj["header_pic"], $userObj["thumbnail_pic"], $userObj["user_education"], $userObj["skill"], $userObj["user_post"], $userObj["user_company"], $userObj["user_documents"], $userObj["role"]);
            $userObj->saveQuietly();

            $imageObj = new Image($item['profile']);
            $userObj->images()->save($imageObj);

            $imageObj = new Image($item['header_pic']);
            $userObj->images()->save($imageObj);

            // User Education - Educational Background
            foreach ($item["user_education"] as $education) {
                $userEducation = new UserEducation($education);
                $userEducation->user()->associate($userObj);
                $userEducation->saveQuietly();
            }

            // User Company - Work Experiment
            foreach ($item["user_company"] as $company) {
                $userCompany = new UserCompany($company);
                $userCompany->user()->associate($userObj);
                $userCompany->saveQuietly();
            }

            // User Documents
            foreach ($item["user_documents"] as $document) {
                $userDocument = new UserDocument($document);
                $userObj->userDocuments()->save($userDocument);
            }

            $userObj->attachRole($item["role"]);

            // Posts and Posts' Likes
            if (User::count() > 1) {
                for ($i = 0; $i < random_int(3, 6); $i++) {
                    $post = UserPost::factory()->makeOne();
                    $userObj->userPosts()->save($post);

                    // Post image $item['user_post']
                    $imageObj = new Image([
                        'url'        => "post-conent-01.png",
                        'image_type' => "content",
                        'alt'        => "post-conent-01.png",
                    ]);
                    $post->images()->save($imageObj);

                    // Post likes
                    $users = User::inRandomOrder()->limit(random_int(User::count() / 2, User::count()))->get();
                    foreach ($users as $user) {
                        $postLike = new UserPostLike();
                        $postLike->user()->associate($user);
                        $post->userPostLikes()->save($postLike);
                    }

                    // Post's comments
                    for ($j = 0; $j < random_int(1, 3); $j++) {
                        $postComment = UserPostComment::factory()->makeOne();
                        $postComment->user()->associate(User::inRandomOrder()->first());
                        $post->userPostComments()->save($postComment);

                        // Posts' comments likes
                        for ($k = 0; $k < random_int(3, 6); $k++) {
                            $postCommentLike = new UserPostCommentLike();
                            $postCommentLike->user()->associate(User::inRandomOrder()->first());
                            $postComment->userPostCommentLikes()->save($postCommentLike);
                        }

                        // Comment's Reply
                        if (random_int(0, 1)) {
                            for ($l = 0; $l < random_int(1, 2); $l++) {
                                $userPostCommentReply = UserPostCommentReply::factory()->makeOne();
                                $userPostCommentReply->user()->associate(User::inRandomOrder()->first());
                                $postComment->userPostCommentReplies()->save($userPostCommentReply);

                                for ($m = 0; $m < random_int(0, 2); $m++) {
                                    $postCommentReplyLike = new UserPostCommentReplyLikes();
                                    $postCommentReplyLike->user()->associate(User::inRandomOrder()->first());
                                    $userPostCommentReply->userPostCommentReplyLikes()->save($postCommentReplyLike);
                                }
                            }
                        }

                    }
                }
            }
        }

        // User Followers
        $followers = User::inRandomOrder()->limit(User::all()->count() / 2)->get();
        foreach ($followers as $follower) {
            for ($i = 0; $i < random_int(4, $followers->count()); $i++) {
                $following = User::inRandomOrder()->first();
                if ($following->id !== $follower->id) $follower->following()->save($following);
            }
        }


        // User Invoice
        $users = User::all();
        foreach ($users as $user) {
            for ($i = 0; $i < random_int(4, $users->count()); $i++) {
                $invoiceObj = Invoice::factory()->makeOne();
                $invoiceObj->user()->associate($user);
                //$invoiceObj->coupon()->associate ($couponObj);
                $invoiceObj->saveQuietly();

                // invoice detail

            }
        }
    }
}
