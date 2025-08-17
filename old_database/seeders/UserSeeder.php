<?php

namespace Database\Seeders;

use App\Enums\GenderStatusEnum;
use App\Models\Image;
use App\Models\Invoice;
use App\Models\PrivacyPolicy;
use App\Models\SocialMedia;
use App\Models\User;
use App\Models\UserBadgeLevel;
use App\Models\UserCompany;
use App\Models\UserEducation;
use App\Models\UserPost;
use App\Models\UserPostComment;
use App\Models\UserPostCommentLike;
use App\Models\UserPostCommentReply;
use App\Models\UserPostCommentReplyLikes;
use App\Models\UserPostLike;
use App\Models\UserPrivacy;
use App\Models\UserSocialMedia;
use App\Services\EvaluationUserBadges;
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
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Landa Trip",
                'lname' => "admin",
                'title' => "Landa Trip Support",
                'slug' => 'landa-trip',
                'email' => "manager@landatrip.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatripadmin"),
                'location' => 3,
                'sex' => GenderStatusEnum::notSay,
                'about_me' => "",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com",
                    ],
                ],
                "profile" => [
                    'url' => 'admin.webp',
                    'image_type' => 'profile',
                    'alt' => 'admin of Landa Trip'
                ],
                "user_education" => [],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [],
                "user_documents" => [],
                "role" => "manager"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => 'Iman Nasr Esfahani - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => 'Iman Nasr Esfahani - Landa Trip'
                ],
                'fname' => "Iman",
                'lname' => "Nasr Esfahani",
                'title' => "Full-stack web developer",
                'email' => "iman.nasr.esfahan@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 3,
                'sex' => GenderStatusEnum::male,
                'about_me' => "Iman Nas is a full-stack web developer that has many projects with backend PHP on WordPress and Laravel and also with python on Django.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com/iman-nasr-esfahan",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/iman.nasr.esfahani?igshid=MDM4ZDc5MmU=",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/profile.php?id=100090810848190",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/iman-nasr-esfahani-b798a8184",
                    ],
                ],
                "profile" => [
                    'url' => 'iman-nasr-esfahani.webp',
                    'image_type' => 'profile',
                    'alt' => ''
                ],
                "user_education" => [
                    [
                        "title" => "Regional Planning",
                        "university" => "University of tehran",
                        "level" => "Master's degree",
                        "from" => "2012",
                        "to" => "2015"
                    ],
                    [
                        "title" => "",
                        "university" => "Tehran University",
                        "level" => "Bachelor's degree",
                        "from" => "2007",
                        "to" => "2011"
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Landa Trip",
                        "position" => "Founder",
                        "from" => "2021",
                        "to" => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position" => "Web developer",
                        "from" => "2019",
                        "to" => "2022"
                    ]
                ],
                "user_documents" => [],
                "role" => "manager"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "admin1",
                'lname' => "admin1",
                'title' => "Admin",
                'email' => "admin1.landatrip@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 4,
                'sex' => GenderStatusEnum::notSay,
                'about_me' => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://facebook.com",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://linkedin.com",
                    ],
                ],
                "profile" => [
                    'url' => 'ali_123.webp',
                    'image_type' => 'profile',
                    'alt' => 'ali 123'
                ],
                "user_education" => [],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [],
                "user_documents" => [],
                "role" => "admin"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "admin2",
                'lname' => "admin2",
                'title' => "Web developer",
                'email' => "admin2.landatrip@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 5,
                'sex' => GenderStatusEnum::male,
                'about_me' => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://facebook.com",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://linkedin.com",
                    ],
                ],

                "profile" => [
                    'url' => 'sam.321.webp',
                    'image_type' => 'profile',
                    'alt' => 'sam 123'
                ],
                "user_education" => [],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [],
                "user_documents" => [],
                "role" => "admin"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "sara",
                'lname' => "esmaili",
                'title' => "designer",
                'email' => "sara.test@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 6,
                'sex' => GenderStatusEnum::female,
                'about_me' => "Lorem ipsum dolor sit amet, eu mundi nullam cotidieque eos, dicta impedit no cum, nec cu alterum propriae mentitum. Per dicit everti aliquam ea. An sit scaevola perfecto, malis accumsan consulatu vix cu. Erroribus deseruisse cotidieque eam ei, te labitur legimus cum. At nonumy diceret has.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://facebook.com",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://linkedin.com",
                    ],
                ],

                "profile" => [
                    'url' => 'sara.987.webp',
                    'image_type' => 'profile',
                    'alt' => 'sara 123'
                ],
                "user_education" => [
                    [
                        "title" => "Urban Planning and Designing",
                        "university" => "Shiraz University",
                        "level" => "Bachelor",
                        "from" => "2007",
                        "to" => "2011"
                    ],
                    [
                        "title" => "Regional Planning",
                        "university" => "Tehran University",
                        "level" => "Master",
                        "from" => "2012",
                        "to" => "2015"
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Landa Trip",
                        "position" => "Founder",
                        "from" => "2021",
                        "to" => null
                    ],
                    [
                        "company_name" => "Melale",
                        "position" => "Web developer",
                        "from" => "2019",
                        "to" => "2022"
                    ]
                ],
                "user_documents" => [],
                "role" => "admin"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => 'Dr. Rasoul moradimehr photo  - LandaTrip'
                ],
                'thumbnail_pic' => [
                    'url' => 'ali_123.webp',
                    'image_type' => 'thumbnail',
                    'alt' => 'Dr. Rasoul moradimehr photo  - LandaTrip'
                ],
                'fname' => "Rasoul",
                'lname' => "Moradimehr",
                'title' => "entrepreneur , Angel investor ",
                'email' => "moradimehr.rasoul@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 7,
                'sex' => GenderStatusEnum::male,
                'about_me' => "Rasoul believes that his main focus is working as an investor and entrepreneur.However , extensive international connections facilitate his selection of more appropriate startups for investment and entrepreneurship.Dr.Rasoul Moradi Mehr has studied in Iran in the major of control and system.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://www.instagram.com/dr.moradimehr.rasoul",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/rasoul.moradimehr",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ca.linkedin.com/in/rasoul-moradi-mehr",
                    ],
                ],

                "profile" => [
                    'url' => 'dr-moradimehr.webp',
                    'image_type' => 'profile',
                    'alt' => 'Dr.moradimehr'
                ],
                "user_education" => [
                    [
                        "title" => "Control & System",
                        "university" => "Islamic Azad University",
                        "level" => "PhD",
                        "from" => "2017",
                        "to" => "2022"
                    ],

                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Landa Trip",
                        "position" => "Co-Founder",
                        "from" => "2021",
                        "to" => null
                    ],
                    [
                        "company_name" => "Co-Founder & President",
                        "position" => "Landa Holding",
                        "from" => "2017",
                        "to" => null
                    ],
                    [
                        "company_name" => "Co-Founder & President",
                        "position" => "irLanda",
                        "from" => "2018",
                        "to" => null
                    ]
                ],
                "user_documents" => [],
                "role" => "admin"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => 'Mehrnoosh heibati'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => 'Mehrnoosh heibati'
                ],
                'fname' => "Mehrnoosh",
                'lname' => "Heibati",
                'title' => "Manager",
                'email' => "mehrnooshheibati1991@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 6,
                'sex' => GenderStatusEnum::female,
                'about_me' => "Mehrnoosh Heibati has a PhD in general microbiology and has management and planning skills. She is currently the manager of the Startup School and has been instrumental in advancing the company's goals",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/mehrnoosh.heibati?igshid=MDM4ZDc5MmU=",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/hadi.soderjani",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/mehrnoosh-heibati-62b117223",
                    ],
                ],

                "profile" => [
                    'url' => 'heibati.webp',
                    'image_type' => 'profile',
                    'alt' => 'Dr Heibati'
                ],
                "user_education" => [
                    [
                        "title" => "Microbiology ,general",
                        "university" => "Islamic Azad University",
                        "level" => "PHD",
                        "from" => "2016",
                        "to" => "2020"
                    ],

                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Landa Startup School",
                        "position" => "Manager",
                        "from" => "2019",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "teacher"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => 'Mahsa Esmaili - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => 'Mahsa Esmaili - Landa Trip'
                ],
                'fname' => "Mahsa",
                'lname' => "Esmaili",
                'title' => "Case Manager",
                'email' => "mahsaesmaili29@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 5,
                'sex' => GenderStatusEnum::female,
                'about_me' => "Mahsa Esmaili has M.Sc of clinical physiology from the isfahan university of Iran . She has been active in this field , and she is also teaching at this university. She has a High teaching and learning spirit;Has a background in general and specialized education as well as English  ",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/dr.hadihasanpour?igshid=MDM4ZDc5MmU=",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/hadi.soderjani",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/mahsa-esmaili",
                    ],
                ],

                "profile" => [
                    'url' => 'mahsa-Esmaili.webp',
                    'image_type' => 'profile',
                    'alt' => 'Mahsa Esmaili'
                ],
                "user_education" => [
                    [
                        "title" => "clinical physiology",
                        "university" => "University of Isfahan",
                        "level" => "Master",
                        "from" => "2018",
                        "to" => "2021"
                    ],
                    [
                        "title" => "Health and Physical Education",
                        "university" => "University of isfahan",
                        "level" => "Bachelor",
                        "from" => "2014",
                        "to" => "2018"
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "IRimmigration Inc",
                        "position" => "Case Manager",
                        "from" => "2022",
                        "to" => null
                    ],
                    [
                        "company_name" => "University of isfahan",
                        "position" => "professor",
                        "from" => "2019",
                        "to" => null
                    ]
                ],
                "user_documents" => [],
                "role" => "teacher"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => 'Lida Parvizi - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => 'Lida Parvizi - Landa Trip'
                ],
                'fname' => "Lida",
                'lname' => "Parvizi",
                'title' => "Assistant",
                'email' => "lida.parvizi.business@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 4,
                'sex' => GenderStatusEnum::female,
                'about_me' => "Lida Parvizi is an immigration activist in Canada and an immigration assistant at irimmigration Inc. She completes immigration forms and collects their files.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/dr.hadihasanpour?igshid=MDM4ZDc5MmU=",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/hadi.soderjani",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/lida-parvizi-ab7b8721a",
                    ],
                ],

                "profile" => [
                    'url' => 'lida-Parvizi.webp',
                    'image_type' => 'profile',
                    'alt' => 'Lida Parvizi'
                ],
                "user_education" => [
                    [
                        "title" => "Computer Hardware Engineering",
                        "university" => "Sepahan University",
                        "level" => "Bachelor's degree",
                        "from" => "2007",
                        "to" => "2011"
                    ],

                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "irimmigration",
                        "position" => "assistant",
                        "from" => "2021",
                        "to" => null
                    ],
                    [
                        "company_name" => "Forough Roshan Pasargad",
                        "position" => "Office affairs",
                        "from" => "2021",
                        "to" => null
                    ]
                ],
                "user_documents" => [],
                "role" => "teacher"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'Dr-hasanpour.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Hadi",
                'lname' => "Hasanpour",
                'title' => "Investor , Entrepreneur",
                'email' => "hadihasanpor@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 8,
                'sex' => GenderStatusEnum::male,
                'about_me' => "With a demonstrated history as an international, accomplished business analyst and entrepreneur,Iran based Hadi Hasanpour bring a unique perspective to the consulting industry .",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/dr.hadihasanpour?igshid=MDM4ZDc5MmU=",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/hadi.soderjani",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/hadi-hasanpour",
                    ],
                ],

                "profile" => [
                    'url' => 'dr-hasanpour.webp',
                    'image_type' => 'profile',
                    'alt' => 'Dr Hasanpour'
                ],
                "user_education" => [
                    [
                        "title" => "Control & System",
                        "university" => "Islamic Azad University",
                        "level" => "Phd candidate",
                        "from" => "2017",
                        "to" => "2023"
                    ],
                    [
                        "title" => "Mechanical Engineering",
                        "university" => "Islamic Azad University",
                        "level" => "Bachelor's degree",
                        "from" => "2019",
                        "to" => "2023"
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "IRimmigration Inc",
                        "position" => "Manager",
                        "from" => "2019",
                        "to" => null
                    ],
                    [
                        "company_name" => "Landa holding",
                        "position" => "CEO",
                        "from" => "2017",
                        "to" => null
                    ]
                ],
                "user_documents" => [],
                "role" => "admin"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => 'Kholoud Hariri - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => 'Kholoud Hariri - Landa Trip'
                ],
                'fname' => "Kholoud",
                'lname' => "Hariri",
                'title' => "Public relation",
                'email' => "kholoudhariri1373@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 9,
                'sex' => GenderStatusEnum::female,
                'about_me' => "",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://www.instagram.com/kholoud______",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://facebook.com",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/kholoud-hariri-b83b96222/es?trk=people-guest_people_search-card",
                    ],
                ],

                "profile" => [
                    'url' => 'kholood-hariri.webp',
                    'image_type' => 'profile',
                    'alt' => 'Kholood Hariri'
                ],
                "user_education" => [
                    [
                        "title" => "Architecture",
                        "university" => "Islamic Azad university,Najafabad Branch",
                        "level" => "Bachelor's degree",
                        "from" => "2011",
                        "to" => "2015"
                    ],

                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "IRimmigration Inc",
                        "position" => "Public Relation , Administrative Assistant",
                        "from" => "2022",
                        "to" => null
                    ],
                    [
                        "company_name" => "Forough Roshan Pasargad",
                        "position" => "Employer",
                        "from" => "2021",
                        "to" => null
                    ]
                ],
                "user_documents" => [],
                "role" => "user"
            ],




            // Users
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'roham-arablou.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Roham",
                'lname' => "Arablou",
                'title' => "Front-end programmer",
                'email' => "roham.arablou06@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 10,
                'sex' => GenderStatusEnum::male,
                'about_me' => "I am 17 years old and I was very interested in computer since I was a child and I decided to enter this field very soon.Currently I have the ability to work with html,css,wordpress and a little bit of php.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/__r0ham_",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/roham-arablou",
                    ],
                ],

                "profile" => [
                    'url' => 'roham-arablou.webp',
                    'image_type' => 'profile',
                    'alt' => 'roham-arablou'
                ],
                "user_education" => [
                    [
                        "title" => "math",
                        "university" => "Adl high school",
                        "level" => "diploma",
                        "from" => "2017",
                        "to" => "2023"
                    ],

                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "IRimmigration Inc",
                        "position" => "wordpress developer",
                        "from" => "2021",
                        "to" => null
                    ],
                    [
                        "company_name" => "Landa startup school",
                        "position" => "intern",
                        "from" => "2021",
                        "to" => null
                    ]
                ],
                "user_documents" => [],
                "role" => "user"
            ],[
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'maryam.png',
                    'image_type' => 'thumbnail',
                    'alt' => 'Maryam Eskandari'
                ],
                'fname' => "Maryam",
                'lname' => "Eskandari",
                'title' => "Content Creator",
                'email' => "maryamesakandari.landa@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 11,
                'sex' => GenderStatusEnum::female,
                'about_me' => "I have been learning English studies for about 10 years.
                                    I passed all English language courses at Isfahan Gooyesh Institution.
                                    After that, I taught English for about two years in VIP classes.
                                    I have an international certificate of ICDL from the Technical and Vocational Training Organization of Iran.
                                    I like and follow sports like volleyball and bodybuilding and I do them in my free times.
                                    I was working in a website design company for one year and I was producing SEO content for different websites.
                                    Since then, I have been working in an immigration company about immigrating to Canada and I have been developing immigration and investment websites.
                                    I am also the content creator and website developer of the Diaco company and Landa Trip association, which has recently received a letter of support from Canada.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/real_minee",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://www.linkedin.com/in/maryam-eskandari-62136a265/",
                    ],
                ],

                "profile" => [
                    'url' => 'maryam.png',
                    'image_type' => 'profile',
                    'alt' => 'Maryam Eskandari'
                ],
                "user_education" => [
                    [
                        "title" => "science ",
                        "university" => "saremiye2",
                        "level" => "diploma",
                        "from" => "2017",
                        "to" => "2020"
                    ], [
                        "title" => "master of psychology",
                        "university" => "Azad university of Isfahan",
                        "level" => "master",
                        "from" => "2020",
                        "to" => null
                    ],

                ],
                "skills" => ['English Teaching', 'SEO Copywriting', 'Web Content Writing', 'Search Engine Optimization (SEO)', 'Icdl'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Landa Trip",
                        "position" => "Content Creator",
                        "from" => "2023",
                        "to" => null
                    ],
                    [
                        "company_name" => "Diaco Center",
                        "position" => "Content Creator",
                        "from" => "2023",
                        "to" => null
                    ]
                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'amin.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Mohammad Amin",
                'lname' => "Asgarian",
                'title' => "Full Stack Developer",
                'email' => "asgarianm17@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 12,
                'sex' => GenderStatusEnum::male,
                'about_me' => "As a 20-year-old React frontend web developer with two years of experience at Forough Roshan Company, I am highly motivated and hardworking. I have completed several frontend projects, and I am committed to continuous learning and growth in my field. With my passion for coding and my ability to collaborate effectively with others, I am excited to take on new challenges and contribute to the success of any team.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/amin-asgarian",
                    ],
                ],

                "profile" => [
                    'url' => 'amin.webp',
                    'image_type' => 'profile',
                    'alt' => 'Dr Hasanpour'
                ],
                "user_education" => [
                    [
                        "title" => "IT",
                        "university" => "Najaf Abad University",
                        "level" => "Bachelor's degree",
                        "from" => "2019",
                        "to" => "2022"
                    ],

                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Forough Roshan Co",
                        "position" => "Web developer",
                        "from" => "2022",
                        "to" => null
                    ],
                    [
                        "company_name" => "Landa Startup school",
                        "position" => "Programming intern",
                        "from" => "2011",
                        "to" => null
                    ]
                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'saman.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Saman",
                'lname' => "Karchegani",
                'title' => "Frontend developer",
                'email' => "samankarchegani@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 13,
                'sex' => GenderStatusEnum::male,
                'about_me' => "I am a Front-end programmer of Farazaman company and I study at Islamic azad University",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/saman-kchn",
                    ],
                ],

                "profile" => [
                    'url' => 'saman.webp',
                    'image_type' => 'profile',
                    'alt' => 'saman karchegani'
                ],
                "user_education" => [

                    [
                        "title" => "Computer Sofware Engineering",
                        "university" => "Islamic Azad University",
                        "level" => "Bachelor's degree",
                        "from" => "2020",
                        "to" => null
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Farazaman",
                        "position" => "junior Front-end developer",
                        "from" => "2019",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'Hoda.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Hoda",
                'lname' => "mahdi",
                'title' => "Apparel and Fashion , Graphic Designer",
                'email' => "mahdihodadesigner@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 12,
                'sex' => GenderStatusEnum::female,
                'about_me' => "My name is Hoda and I work at Forough Roshan Co and do graphic design work",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/hoda-mahdi",
                    ],
                ],

                "profile" => [
                    'url' => 'hoda.webp',
                    'image_type' => 'profile',
                    'alt' => 'hoda mahdi'
                ],
                "user_education" => [
                    [
                        "title" => "Graphic design",
                        "university" => "Sepehr University",
                        "level" => "Bachelor's degree",
                        "from" => "2014",
                        "to" => "2018"
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Hoda mahdi group",
                        "position" => "Founder&Manager",
                        "from" => "2014",
                        "to" => null
                    ],
                    [
                        "company_name" => "Forough Roshan Co",
                        "position" => "Graphic Designer",
                        "from" => "2022",
                        "to" => null
                    ]
                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'ariana.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Ariana",
                'lname' => "Shafie",
                'title' => "Frontend developer",
                'email' => "arianashafie142@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 11,
                'sex' => GenderStatusEnum::female,
                'about_me' => "I am a Front-end programmer of Farazaman company and I study at Islamic azad University",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/ariana-shafie",
                    ],
                ],

                "profile" => [
                    'url' => 'ariana.webp',
                    'image_type' => 'profile',
                    'alt' => 'ariana shafie'
                ],
                "user_education" => [

                    [
                        "title" => "Computer Engineering",
                        "university" => "Islamic Azad University",
                        "level" => "Bachelor's degree",
                        "from" => "2022",
                        "to" => null
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Farazaman",
                        "position" => "Front-end developer",
                        "from" => "2019",
                        "to" => null
                    ],
                    [
                        "company_name" => "Landa trip",
                        "position" => "Front-end developer",
                        "from" => "2019",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'arshia.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Arshia",
                'lname' => "Nasiri",
                'title' => "Web developer",
                'email' => "marshian03@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 10,
                'sex' => GenderStatusEnum::male,
                'about_me' => "Marshian is the name I chose for my character.you can find me with this ID in all social networks. Marshian started his activity in the field of computer engineering and programming in 2022 and he's currently doing serious activities in programming ",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/Mohammad-Arshia-Nasiri",
                    ],
                ],

                "profile" => [
                    'url' => 'arshia.webp',
                    'image_type' => 'profile',
                    'alt' => 'Arshia nasiri'
                ],
                "user_education" => [

                    [
                        "title" => "Computer Science",
                        "university" => "Islamic Azad University",
                        "level" => "Bachelor's degree",
                        "from" => "2022",
                        "to" => null
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Farazaman",
                        "position" => "UI designer",
                        "from" => "2023",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'mahrokh.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Mahrokh",
                'lname' => "Lotfi",
                'title' => "Frontend developer",
                'email' => "mahrokhlf00@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 9,
                'sex' => GenderStatusEnum::male,
                'about_me' => "I am a Front-end programmer of Farazaman company and I study at Islamic azad University",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/mahrokh-lotfi",
                    ],
                ],

                "profile" => [
                    'url' => 'mahrokh.webp',
                    'image_type' => 'profile',
                    'alt' => 'mahrokh lotfi '
                ],
                "user_education" => [

                    [
                        "title" => "Computer Sofware Engineering",
                        "university" => "Islamic Azad University",
                        "level" => "Bachelor's degree",
                        "from" => "2020",
                        "to" => null
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Farazaman",
                        "position" => "junior Front-end developer",
                        "from" => "2019",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'ali-soleymany',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Ali",
                'lname' => "Soleymni",
                'title' => "Accountatnt",
                'email' => "alisolimani95950@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 8,
                'sex' => GenderStatusEnum::male,
                'about_me' => "I joined Landa Company as an apprentice in 2021 and I am currently an accountant of this company. I am also studying business management at Isfahan University.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://www.linkedin.com/in/ali-soleymani-b761b6223/",
                    ],
                ],

                "profile" => [
                    'url' => 'ali-soleymany.webp',
                    'image_type' => 'profile',
                    'alt' => 'Ali soleymani '
                ],
                "user_education" => [

                    [
                        "title" => "Bussines management",
                        "university" => "University of Isfahan",
                        "level" => "Bachelor's degree",
                        "from" => "2019",
                        "to" => null
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Landa Startup school",
                        "position" => "Intern",
                        "from" => "2021",
                        "to" => null
                    ],
                    [
                        "company_name" => "Forough Roshan Co",
                        "position" => "Accounting",
                        "from" => "2022",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'ainaz-raisi.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Ainaz",
                'lname' => "Raisi",
                'title' => "Graphic Designer",
                'email' => "Raisiainaz@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 7,
                'sex' => GenderStatusEnum::male,
                'about_me' => "My name is Ainaz, and since I was very interested in graphics, I joined Landa as an apprentice in 2021, and I am still working as a graphic designer.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://www.linkedin.com/in/ainaz-raisi-97457a21b/",
                    ],
                ],

                "profile" => [
                    'url' => 'ainaz-raisi.webp',
                    'image_type' => 'profile',
                    'alt' => 'Ainaz raisi '
                ],
                "user_education" => [

                    [
                        "title" => "Grafic",
                        "university" => "Khalij fars high school",
                        "level" => "Diploma",
                        "from" => "2021",
                        "to" => null
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Landa startup school",
                        "position" => "Graphic Desinger",
                        "from" => "2022",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'saba-mokhtari.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Saba",
                'lname' => "Mokhtari",
                'title' => "Figma designer",
                'email' => "sabamokhtari.landa@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 6,
                'sex' => GenderStatusEnum::male,
                'about_me' => "My name is Saba. I joined Landa as an apprentice and am currently designing Figma.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://www.linkedin.com/in/saba-mokhtari-25107725b/",
                    ],
                ],

                "profile" => [
                    'url' => 'saba-mokhtari.webp',
                    'image_type' => 'profile',
                    'alt' => 'mahrokh lotfi '
                ],
                "user_education" => [

                    [
                        "title" => "Computer Software Engineering",
                        "university" => "Islamic Azad University",
                        "level" => "Bachelor's degree",
                        "from" => "2020",
                        "to" => null
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Landa startup school",
                        "position" => "Intern",
                        "from" => "2022",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'sobhan-emami.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Sobhan",
                'lname' => "Emami",
                'title' => "Web developer",
                'email' => "1371287@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 5,
                'sex' => GenderStatusEnum::male,
                'about_me' => "At first i was a Designer and then I intrested to programming",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://www.linkedin.com/in/",
                    ],
                ],

                "profile" => [
                    'url' => 'sobhan-emami.webp',
                    'image_type' => 'profile',
                    'alt' => 'Sobhan'
                ],
                "user_education" => [

                    [
                        "title" => "Math architecture",
                        "university" => "Sepahan University",
                        "level" => "Bachelor's degree",
                        "from" => "2017",
                        "to" => null
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Forough Roshan Pasargad",
                        "position" => "Web developer",
                        "from" => "2023",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "agent"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'ehsan-aliakbari.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Ehsan",
                'lname' => "Aliakbari",
                'title' => "UX Designer , Graphic Designer",
                'email' => "ehsanaliakbari.landa@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 4,
                'sex' => GenderStatusEnum::male,
                'about_me' => "I am a freelance graphic designer and I am very interested in design work and I studied at Payam Noor University",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://www.linkedin.com/in/ehsan-aliakbari/",
                    ],
                ],

                "profile" => [
                    'url' => 'ehsan-aliakbari.webp',
                    'image_type' => 'profile',
                    'alt' => 'Ehsan'
                ],
                "user_education" => [

                    [
                        "title" => "Graphic",
                        "university" => "Payame Noor University",
                        "level" => "Bachelor's degree",
                        "from" => "2015",
                        "to" => "2019"
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Freelance",
                        "position" => "Graphic Designer",
                        "from" => "2010",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'parissa-hatami.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Parissa",
                'lname' => "Hatami",
                'title' => "French Teacher",
                'email' => "@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 8,
                'sex' => GenderStatusEnum::female,
                'about_me' => "I am a French Teacher, likes travelling and explore the world",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/parissa-hatmai",
                    ],
                ],

                "profile" => [
                    'url' => 'parissa-hatami.webp',
                    'image_type' => 'profile',
                    'alt' => 'parissa hatami'
                ],
                "user_education" => [

                    [
                        "title" => "French Literacy",
                        "university" => "Islamic Azad University",
                        "level" => "Bachelor's degree",
                        "from" => "2017",
                        "to" => "2020"
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Melale",
                        "position" => "Language Institute Manager",
                        "from" => "2021",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => ' - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => 'elham-nasr.webp',
                    'image_type' => 'thumbnail',
                    'alt' => ' - Landa Trip'
                ],
                'fname' => "Elham",
                'lname' => "Nasr Esfahani",
                'title' => "Accountant",
                'email' => "elham.nasr@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 9,
                'sex' => GenderStatusEnum::female,
                'about_me' => "I am an accountant and Yoga trainer.",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://ir.linkedin.com/in/elham-nasr",
                    ],
                ],

                "profile" => [
                    'url' => 'elham-nasr.webp',
                    'image_type' => 'profile',
                    'alt' => 'elham nasr esfahani'
                ],
                "user_education" => [
                    [
                        "title" => "Microbiology ,general",
                        "university" => "Islamic Azad University",
                        "level" => "Bachlor",
                        "from" => "2014",
                        "to" => "2018"
                    ],
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Ista Saze Atra",
                        "position" => "CEO",
                        "from" => "2019",
                        "to" => null
                    ],

                ],
                "user_documents" => [],
                "role" => "user"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => 'Fahimeh Sajadi - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => 'Fahimeh Sajadi - Landa Trip'
                ],
                'fname' => "Fahimeh",
                'lname' => "Sajadi",
                'title' => "Front-End web developer",
                'slug' => 'landa-trip',
                'email' => "fahimehsjd77@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("5120064159"),
                'location' => 10,
                'sex' => GenderStatusEnum::female,
                'about_me' => "Fahimeh sajadi is a Front-end developer that work on many projects in React and bootstrap and also figma",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/fahimsjd?igshid=ZGUzMzM3NWJiOQ==",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://www.linkedin.com/mwlite/in/fahimeh-sajadi-50a399202",
                    ],
                ],
                "profile" => [
                    'url' => 'fahimeh-sajadi.webp',
                    'image_type' => 'profile',
                    'alt' => 'admin of Landa Trip'
                ],
                "user_education" => [
                    [
                    "title" => "Computer Engineer",
                    "university" => "University of Shahre-kord",
                    "level" => "",
                    "from" => "2017",
                    "to" => "2021"
                    ]
                ],
                "skills" => ['react', 'php'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Landa Trip",
                        "position" => "Web developer",
                        "from" => "2023",
                        "to" => null
                    ],
                    [
                        "company_name" => "University Isfahan",
                        "position" => "Web developer",
                        "from" => "2022",
                        "to" => "2023"
                    ],
                    [
                        "company_name" => "Isfahan Hub",
                        "position" => "Web developer",
                        "from" => "2019",
                        "to" => "2022"
                    ],
                ],
                "user_documents" => [],
                "role" => "manager"
            ],
            [
                'header_pic' => [
                    'url' => 'Landa-trip-header.webp',
                    'image_type' => 'header',
                    'alt' => 'Ali Khavari - Landa Trip'
                ],
                'thumbnail_pic' => [
                    'url' => '',
                    'image_type' => 'thumbnail',
                    'alt' => 'Ali Khavari - Landa Trip'
                ],
                'fname' => "Ali",
                'lname' => "Khavari",
                'title' => "Application developer",
                'email' => "sdyarash@gmail.com",
                'email_verified_at' => Carbon::Now(),
                "password" => bcrypt("landatriptest123"),
                'location' => 11,
                'sex' => GenderStatusEnum::male,
                'about_me' => "Ali Khavari is an application developer who designs the application and implements it with Flutter",
                "social_media" => [
                    [
                        "social_media_title"    =>  "twitter",
                        "address"               =>  "https://twitter.com/iman-nasr-esfahan",
                    ],
                    [
                        "social_media_title"    =>  "instagram",
                        "address"               =>  "https://instagram.com/alikhavarii13?igshid=NTc4MTIwNjQ2YQ==",
                    ],
                    [
                        "social_media_title"    =>  "facebook",
                        "address"               =>  "https://www.facebook.com/profile.php?id=100090810848190",
                    ],
                    [
                        "social_media_title"    =>  "linkedin",
                        "address"               =>  "https://www.linkedin.com/in/ali-khavari-10b737191",
                    ],
                ],
                "profile" => [
                    'url' => 'ali-khavari.webp',
                    'image_type' => 'profile',
                    'alt' => ''
                ],
                "user_education" => [
                    [
                        "title" => "Regional Planning",
                        "university" => "University of tehran",
                        "level" => "Master's degree",
                        "from" => "2012",
                        "to" => "2015"
                    ],
                    [
                        "title" => "Computer Engineer",
                        "university" => "khoasgan University",
                        "level" => "Bachelor's degree",
                        "from" => "2020",
                        "to" => null
                    ]
                ],
                "skills" => ['figma', 'flutter'],
                "user_post" => [
                    "title" => "",
                    "location" => ""
                ],
                "user_company" => [
                    [
                        "company_name" => "Landa Trip",
                        "position" => "Application Developer",
                        "from" => "2022",
                        "to" => null
                    ],
                    [
                        "company_name" => "Nicode",
                        "position" => "Application Developer",
                        "from" => "2020",
                        "to" => "2022"
                    ]
                ],
                "user_documents" => [],
                "role" => "user"
            ],

        ];

        foreach ($items as $item) {

            $userObj = new User($item);
            unset($userObj["social_media"], $userObj["profile"], $userObj["header_pic"], $userObj["thumbnail_pic"], $userObj["user_education"], $userObj["user_post"], $userObj["user_company"], $userObj["user_documents"], $userObj["role"]);
                $userObj->withoutEvents(function () use ($userObj) {
                    $userObj->id = $userObj->newUniqueId();
                    $userObj->slug = $userObj::makeSlug($userObj->fname . "-" . $userObj->lname);
                    $userObj->save();
                });


            $imageObj = new Image($item['profile']);
            $userObj->images()->save($imageObj);

            $imageObj = new Image($item['header_pic']);
            $userObj->images()->save($imageObj);

            // User Social Media
            foreach ($item["social_media"] as $socialmedia) {
                $socialMediaObj = SocialMedia::where("title", "=", $socialmedia["social_media_title"])->first();
                unset($socialmedia["social_media_title"]);
                if($socialMediaObj) {
                    $userSocialMedia = new UserSocialMedia($socialmedia);
                    $userSocialMedia->user()->associate($userObj);
                    $userSocialMedia->socialMedia()->associate($socialMediaObj);
                    $userSocialMedia->saveQuietly();
                }
            }

            // Privacy and policy   UserSeeder.php
            foreach (PrivacyPolicy::all() as $privacyObj) {
                $userPrivacyObj = new UserPrivacy();
                $userPrivacyObj->privacyPolicy()->associate($privacyObj);
                $userPrivacyObj->user()->associate($userObj);
                $userPrivacyObj->status = $privacyObj->status[array_rand($privacyObj->status)];
                $userPrivacyObj->saveQuietly();
            }

            // User Education - Educational Background
            foreach ($item["user_education"] as $education) {
                $userEducation = new UserEducation($education);
                $userObj->userEducations()->save($userEducation);
            }

            // User Company - Work Experiment
            foreach ($item["user_company"] as $company) {
                $userCompany = new UserCompany($company);
                $userObj->userCompanies()->save($userCompany);
            }

            $userObj->addRole($item["role"]);

            // Posts and Posts' Likes
            if ($userObj->hasRole(['user', 'teacher'])) {
                for ($i = 0; $i < random_int(3, 6); $i++) {
                    $post = UserPost::factory()->makeOne();
                    $userObj->userPosts()->save($post);

                    // Post image $item['user_post']
                    $imageObj = new Image([
                        'url' => "post-" . rand(1, 25) . ".webp",
                        'image_type' => "content",
                        'alt' => "post-01.webp",
                    ]);
                    $post->images()->save($imageObj);

                    // Post likes
                    $users = User::whereHasRole('user')->orWhereHasRole('teacher')->inRandomOrder()->limit(random_int(User::count() / 2, User::count()))->get();
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
        $followers = User::whereHasRole('user')->orWhereHasRole('teacher')->inRandomOrder()->limit(User::all()->count() / 2)->get();

        foreach ($followers as $follower) {
            for ($i = 0; $i < random_int(4, $followers->count()); $i++) {
                $following = User::inRandomOrder()->first();
                if ($following->id !== $follower->id) $follower->following()->save($following);
            }
        }


        // User Invoice
        $users = User::whereHasRole('user')->orWhereHasRole('teacher')->get();
        foreach ($users as $user) {
            for ($i = 0; $i < random_int(4, $users->count()); $i++) {
                $invoiceObj = Invoice::factory()->makeOne();
                $invoiceObj->user()->associate($user);
                //$invoiceObj->coupon()->associate ($couponObj);
                $invoiceObj->withoutEvents(function () use ($invoiceObj) {
                    $invoiceObj->id = $invoiceObj->newUniqueId();
                    $invoiceObj->save();
                });;

                // invoice detail

            }
        }
    }
}
