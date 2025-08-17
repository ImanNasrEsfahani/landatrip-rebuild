<?php

namespace Database\Seeders;

use App\Enums\CertificationStatusEnum;
use App\Enums\GroupStatusEnum;
use App\Enums\GroupUserStatusEnum;
use App\Enums\TourStatusEnums;
use App\Models\Certification;
use App\Models\Group;
use App\Models\GroupItinerary;
use App\Models\GroupItineraryTeacherAccommodation;
use App\Models\GroupPost;
use App\Models\GroupTutor;
use App\Models\Image;
use App\Models\Language;
use App\Models\StartPoint;
use App\Models\TermAndCondition;
use App\Models\Tour;
use App\Models\TourComment;
use App\Models\TourCommentLike;
use App\Models\TourCommentReply;
use App\Models\TourCommentReplyLike;
use App\Models\TourExclude;
use App\Models\TourGallery;
use App\Models\TourHighlight;
use App\Models\TourInclude;
use App\Models\TourItinerary;
use App\Models\Transportation;
use App\Models\User;
use App\Models\UserCertificate;
use App\Models\UserRating;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            // English
            [
                'header_pic'           => [
                    'url'        => 'think-strategically-and-make-your-ideas-a-reality.webp',
                    'image_type' => 'header',
                    'alt'        => 'Think Strategically and Make Your Ideas a Reality - Management Business Analysis - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'think-strategically-and-make-your-ideas-a-reality.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Think Strategically and Make Your Ideas a Reality - Management Business Analysis - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'think-strategically-and-make-your-ideas-a-reality.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Think Strategically and Make Your Ideas a Reality - Management Business Analysis - Landa Trip'
                ],
                'language_id'          => 1,
                'title'                => 'Think Strategically and Make Your Ideas a Reality',
                'short_summary'        => 'Understand the essentials of decision-making, strategic thinking, and project implementation success',
                'city_id'              => 793,
                //'group_size'           => '8 - 12',
                ////'accommodation'        => '4-Star Hotel',
                //'meals'                => '4 Breakfast, 2 lunch, and 1 dinner',
                //'days'                 => 5,
                //'nights'               => 4,
                //'price'                     =>  550,
                'skills'               => 'Management, Business Analysis',
                'tour_overview'        => '<p class=\'text-justify ml-3 mb-1\'>Lately, Economic chaos like the trade wars, the Covid-19 outbreak, the oil crisis, and Brexit have a great impact on businesses around the world, so how do think, and making-decision in these conditions?</p> <p class=\'text-justify ml-3 mb-1\'>Thinking strategically is the best approach for your personal and business life. It has a procedural flow that should be a habit in your mind. It considers all of the strengths, opportunities, threats, and weaknesses altogether.</p> <p class=\'text-justify ml-3 mb-1\'>In this course, you make a specific time for yourself and improve your mind and abilities far from all of detracting issues.</p>',
                'highlights'           => [
                    [
                        'title' => 'Develop your strategic thinking ability'
                    ],
                    [
                        'title' => 'Make strategic thinking a habit'
                    ],
                    [
                        'title' => 'How to be more agile and fit for today’s rapid changes'
                    ],
                    [
                        'title' => 'Increase the likelihood of success of your projects and professional life'
                    ],
                    [
                        'title' => 'How to have quick responses to problems'
                    ],
                    [
                        'title' => 'Change and upgrade your personal and professional framework'
                    ],
                ],
                'itineraries'          => [
                    [
                        'title'       => 'Day 1: Arrival and warm welcome',
                        'description' => '<p>The start of your journey is from Imam Khomeini International airport (IKA) with a light air trip (about 2 and half hours) to Istanbul airport (IST). Our vans are waiting for you at the airport to have a calm and safe transfer to the hotel.</p> <p>After a short rest, and placing baggage, we go sightseeing on Esteghlal Avenue (İstiklâl Caddesi) altogether. Our visit continues along this street and its monuments. like Çiçek Pasajı, Galatasaray High School, and etc. our walking is to the side of Narmanlı Han for dinner time.</p>'
                    ],
                    [
                        'title'       => 'Day 2: The start of the Education journey',
                        'description' => '<p>The breakfast will be served in the hotel, which is also near the classroom, so please attend the classroom before 9:30 am TRT time.</p> <p>On the first day, we have a short introduction to each other. It caused to make a friendly and cooperative atmosphere between students and the lecturer.</p> <p>The class will be until evening (17:00 local time TRT) with two break times and one lunch-time that is included in the tour package.</p>'
                    ],
                    [
                        'title'       => 'Day 3: Works best for the most',
                        'description' => '<p>This day is the turning point in your education journey, so please bring all of your ability to act. This day’s class will be held from 9:30 to 17:00 like yesterday but with a lot of class activity, queries, and examples.</p> <p>You should build your critical and strategic approach in your mind. You should do it repeatedly to make it from a thinking way to a habit.</p>'
                    ],
                    [
                        'title'       => 'Day 4: Time and Opportunities Are Running out',
                        'description' => '<p>This day is the last day of your class. The class is part-time (from 9:30 morning to 13:00 TRT local time) and will be ended before lunchtime.</p> <p>After that, you are free for your leisure time until night. We will have a delicious dinner for the goodbye party on the last night of this course and in this beautiful city.</p>'
                    ],
                    [
                        'title'       => 'Day 5: The last seconds',
                        'description' => '<p>After breakfast, All of the student travelers are ready for departure at the airport.</p> <p>A group photo, new friends, new connections, and certifications will be the best souvenirs from this journey for yourself and your business.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'Airplane ticket (two ways)',
                    ],
                    [
                        'title' => 'Accommodation in 4 stars hotel',
                    ],
                    [
                        'title' => 'Airport transportation',
                    ],
                    [
                        'title' => '4 breakfasts',
                    ],
                    [
                        'title' => '2 lunches',
                    ],
                    [
                        'title' => '1 dinner',
                    ],
                    [
                        'title' => 'Course and certifications',
                    ],
                    [
                        'title' => 'Insurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'Departure taxes from Iran'
                    ],
                    [
                        'title' => 'Imam Khomeini airport transportation'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "strategically-course-1.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-2.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-3.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-4.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-5.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-6.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-7.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-8.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-9.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "Think Strategically and Make Your Ideas a Reality",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => 'How much is the insurance for the travel for each person?',
                        'answer'   => 'about 100 billion rials (3,000 US dollars) for injured and bodily disabilities. And 2x more of that for accidental death.'
                    ],
                    [
                        'question' => 'What documents are essential for this tour package?',
                        'answer'   => 'Although a passport is the only official document for your travel, having 5-year executive management is necessary for participation.'
                    ],
                    [
                        'question' => 'How can I cancel my travel course?',
                        'answer'   => 'You should cancel your travel at least 12 days before departure. In this condition, you can pay back 70% of your payment. After this date, unfortunately, it isn’t possible to return any payment.'
                    ],
                    [
                        'question' => 'Can I travel with my husband/wife? Or my children?',
                        'answer'   => 'Yes. It’s possible to have fellow–travelers with you. But please check with Landa trip for accommodation, an airplane ticket, and so on.'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Ali',
                        'star'    => 4,
                        'comment' => 'It was amazing leisure and educational time for me. The behavior of tutor was so respectful. The only issue was the lack of free time in Istanbul.',
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'Thanks for your comment.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Sam',
                        'star'    => 5,
                        'comment' => 'This travel course changes my mind. I feel upgraded in my thinking way to the world',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Sara',
                        'star'    => 3,
                        'comment' => 'The course was fantastic, but the distance between the hotel and the classroom was long for me.',
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'Thanks your a lot.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Parsa',
                        'star'    => 4,
                        'comment' => 'Just magnificent mate.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Soheil',
                        'star'    => 5,
                        'comment' => 'This course was elegant work dude.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Melika',
                        'star'    => 5,
                        'comment' => 'I want to learn this kind of style! Teach me more.',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Think Strategically for SAAS - Landa Trip'
                        ],
                        "title"                   => "Think Strategically for SAAS companies 2022 02",
                        "start_date_tour"         => Carbon::parse('2025-02-01'),
                        "end_date_tour"           => Carbon::parse('2025-02-10'),
                        "min_capacity"            => 10,
                        "max_capacity"            => 20,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2024-11-25'),
                        "end_registration_date"   => Carbon::parse('2024-12-25'),
                        //'accommodation'        => '4-Star Hotel',

                        //"price"                  => 550,
                        "status"                  => GroupStatusEnum::preRegistration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 356,
                                "ending_location"   => 356,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => false,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 4,
                                            "city"        => 385
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 320
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Think Strategically for SAAS in the autumn - Landa Trip'
                        ],
                        "title"                   => "Think Strategically for SAAS companies 2023 10",
                        "start_date_tour"         => Carbon::parse('2025-01-01'),
                        "end_date_tour"           => Carbon::parse('2025-01-10'),
                        "min_capacity"            => 10,
                        "max_capacity"            => 20,
                        "days"                    => 7,
                        "nights"                  => 6,
                        "start_registration_date" => Carbon::parse('2024-08-25'),
                        "end_registration_date"   => Carbon::parse('2024-12-25'),
                        //'accommodation'        => '5-Star Hotel',
                        //"price"                  => 600,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 685,
                                "ending_location"   => 689,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Think Strategically for SAAS in the winter - Landa Trip'
                        ],
                        "title"                   => "Think Strategically for SAAS companies 2023 12",
                        "start_date_tour"         => Carbon::parse('2025-12-01'),
                        "end_date_tour"           => Carbon::parse('2025-12-10'),
                        "min_capacity"            => 10,
                        "max_capacity"            => 20,
                        "days"                    => 3,
                        "nights"                  => 2,
                        "start_registration_date" => Carbon::parse('2024-10-25'),
                        "end_registration_date"   => Carbon::parse('2024-11-25'),
                        //'accommodation'          => '4-Star Hotel',
                        //"price"                  => 600,
                        "status"                  => GroupStatusEnum::startSoon,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            =>
                            [
                                [
                                    "starting_location" => 154,
                                    "ending_location"   => 169,
                                    'transport'         => 'Airport transport for arrival and departure',
                                ],
                                [
                                    "starting_location" => 154,
                                    "ending_location"   => 169,
                                    'transport'         => 'Airport transport for arrival and departure',
                                ]

                            ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'seo-tips-and-tricks.webp',
                    'image_type' => 'header',
                    'alt'        => 'SEO, Tips and Tricks - Information Technology, Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'seo-tips-and-tricks.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'SEO, Tips and Tricks - Information Technology, Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'seo-tips-and-tricks.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'SEO, Tips and Tricks - Information Technology, Digital Marketing - Landa Trip'
                ],
                'language_id'          => 1,
                'title'                => 'SEO, Tips and Tricks',
                'short_summary'        => 'Understand the small and beneficial tips about search engine optimization, and practical tricks to improve your websites',
                'city_id'              => 11,
                //'group_size'           => '8-14 people',
                ////'accommodation'        => '4-Star Hotel',
                //'meals'                => '4 Breakfast, 2 lunch, and 1 dinner',
                //'transport'            => 'Airport transport for arrival and departure',
                //'days'                 => 5,
                //'nights'               => 4,
                //'price'                     =>  195,
                'skills'               => 'Information Technology, Digital Marketing',
                'tour_overview'        => '<p>Nowadays the internet is the most important tool for presenting and selling almost products. And websites are the front end of this trend. If you like to have a popular website for promoting your services and products, SEO tips are essential.</p> <p>SEO is the abbreviation of Search Engine Optimization, which is the process of gaining a better place in search engine results for target keywords in target areas and markets.</p> <p>In this travel course, we learn about tips and tricks to use robot’s search engines for benefit of us. We learn, what to do on our websites and how to find and plan for Search engine optimization.</p>',
                'highlights'           => [
                    [
                        'title' => 'Learning about google algorithms'
                    ],
                    [
                        'title' => 'A competitive analysis on a webpage '
                    ],
                    [
                        'title' => 'Get an understanding of how search engines SEO work'
                    ],
                    [
                        'title' => 'Submit your website to Google and make it easier for search engines to index your site'
                    ],
                    [
                        'title' => 'Keyword research'
                    ],
                    [
                        'title' => 'Page Speed Analysis'
                    ],
                    [
                        'title' => 'Learn how to create backlinks from verified and reliable resources'
                    ],
                    [
                        'title' => 'Avoid Negative SEO work'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'Day 1: Welcome to Kish Island',
                        'description' => '<p>After a short air trip to Kish Island in the morning. We will transfer and check in at the hotel. Evening leisure time is a friendly meeting in one of the beautiful coffee shops near legacy beach. All of the students and the tutor will be introduced to each other for a friendly journey and education.</p>'
                    ],
                    [
                        'title'       => 'Day 2: The course is going on, Are you ready?',
                        'description' => '<p>After eating breakfast in the hotel, only a short walking necessary to arrive at the classroom. The start of class is 9:00 am and you have two short breaks and one lunchtime until 5:00 pm, which is the end.</p> <p>In this class, you learn what SEO is, why to use of, and how google algorithms work.</p> <p>It’s rational that theoretical content is more than practical on the first day but you should absorb them.</p>'
                    ],
                    [
                        'title'       => 'Day 3: The practical analysis starts',
                        'description' => '<p>Like yesterday, the class hour is the same, but the content is turning from theoretical and PowerPoint to practical analysis of the businesses. Your businesses have a competitor and keyword analysis by the cooperation of the others. It’s one of the unique advantages in the above of similar courses.</p> <p>You should take note of the comments and do them after the course.</p>'
                    ],
                    [
                        'title'       => 'Day 4: Apply your knowledge',
                        'description' => '<p>This day is the last day of your class. The class is part-time (from 9:30 morning to 13:00) and will be ended before lunchtime.</p> <p>It’s time to apply your new knowledge to your business website in a practical way on your laptop or PC’s classroom.</p>'
                    ],
                    [
                        'title'       => 'Day 5: The last seconds',
                        'description' => '<p>After breakfast, all of the student travelers are ready for departure at the airport.</p> <p>A group photo, new friends, new connections, and certifications will be the best souvenirs from this journey for yourself and your business.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'Airplane ticket (two ways)',
                    ],
                    [
                        'title' => 'Accommodation in 4 stars hotel',
                    ],
                    [
                        'title' => 'Airport transportation',
                    ],
                    [
                        'title' => '4 breakfasts',
                    ],
                    [
                        'title' => '2 lunches',
                    ],
                    [
                        'title' => '1 dinner',
                    ],
                    [
                        'title' => 'Course and certifications',
                    ],
                    [
                        'title' => 'Insurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => '•	The airport transportation'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "seo-course-1.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-2.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-3.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-4.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-5.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-6.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-7.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-8.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-9.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-13.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-14.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-15.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-16.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-17.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-18.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "SEO, Tips and Tricks",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => 'How much is the insurance for the travel for each person?',
                        'answer'   => 'About 100 billion rials (3,000 US dollars) for injured and bodily disabilities. And 2x more of that for accidental death.'
                    ],
                    [
                        'question' => 'What documents are essential for this tour package?',
                        'answer'   => 'Although a passport is the only official document for your travel, having 5-year executive management is necessary for participation.'
                    ],
                    [
                        'question' => 'How can I cancel my travel course?',
                        'answer'   => 'You should cancel your travel at least 12 days before departure. In this condition, you can pay back 70% of your payment. After this date, unfortunately, it isn’t possible to return any payment.'
                    ],
                    [
                        'question' => 'Can I travel with my husband/wife? Or my children?',
                        'answer'   => 'Yes. It’s possible to have fellow–travelers with you. But please check with Landa trip for accommodation, an airplane ticket, and so on.'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Maryam',
                        'star'    => 5,
                        'comment' => 'I can understand the process of ranking in google results in this course. I will start to apply all of the tips in my online business from tomorrow.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Mohammad',
                        'star'    => 4,
                        'comment' => 'Now I can add SEO service to my website building service. I like to have a longer course.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Mehdi',
                        'star'    => 5,
                        'comment' => 'Highly excellent! Recommend for all online business owners.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Leila',
                        'star'    => 3,
                        'comment' => 'Very elegant experience, with new friends. But I like to have a longer and more practical class activity. Too many questions waste the time of the class. I like to be more.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Reza',
                        'star'    => 3,
                        'comment' => 'This atmosphere has navigated right into my heart.',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'SEO Tips and Tricks - Landa Trip'
                        ],
                        "title"                   => "SEO, Tips and Tricks 2022 03",
                        "start_date_tour"         => Carbon::parse('2025-02-01'),
                        "end_date_tour"           => Carbon::parse('2025-02-10'),
                        "min_capacity"            => 10,
                        "max_capacity"            => 20,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-01-01'),
                        "end_registration_date"   => Carbon::parse('2025-01-18'),
                        //'accommodation'        => 'Ecolodge and camping',
                        //"price"                  => 195,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 884,
                                "ending_location"   => 896,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]

                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]

                    ],
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'SEO Tips and Tricks - Landa Trip'
                        ],
                        "title"                   => "SEO, Tips and Tricks 2023 05",
                        "start_date_tour"         => Carbon::parse('2025-05-01'),
                        "end_date_tour"           => Carbon::parse('2025-05-10'),
                        "min_capacity"            => 8,
                        "max_capacity"            => 14,
                        "days"                    => 10,
                        "nights"                  => 9,
                        "start_registration_date" => Carbon::parse('2024-10-25'),
                        "end_registration_date"   => Carbon::parse('2024-11-18'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 195,
                        "status"                  => GroupStatusEnum::onGoing,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 45,
                                "ending_location"   => 56,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]

                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]

                    ],
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'SEO Tips and Tricks - Landa Trip'
                        ],
                        "title"                   => "SEO, Tips and Tricks 2023 08",
                        "start_date_tour"         => Carbon::parse('2025-09-01'),
                        "end_date_tour"           => Carbon::parse('2025-09-10'),
                        "min_capacity"            => 8,
                        "max_capacity"            => 14,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2024-09-25'),
                        "end_registration_date"   => Carbon::parse('2024-10-18'),
                        //'accommodation'        => '3-Star Hotel',
                        //"price"                  => 210,
                        "status"                  => GroupStatusEnum::completed,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 369,
                                "ending_location"   => 365,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'ielts-preparation-course.webp',
                    'image_type' => 'header',
                    'alt'        => 'IELTS, preparation course - Language - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'ielts-preparation-course.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'IELTS, preparation course - Language - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'ielts-preparation-course.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'IELTS, preparation course - Language - Landa Trip'
                ],
                'language_id'          => 1,
                'title'                => 'IELTS, preparation course',
                'short_summary'        => 'IELTS is a standard exam to recognize English Language Proficiency. It has variety of skills and questions that need to practicing and have tact ticks to answer them in short time. This course is learning this by the best examiners.',
                'city_id'              => 2759,
                //'group_size'           => '10-12 people',
                ////'accommodation'        => '3-Star Hotel',
                //'meals'                => '14 Breakfast',
                //'transport'            => 'Airport transport for arrival and departure',
                //'days'                 => 15,
                //'nights'               => 14,
                //'price'                     =>  650,
                'skills'               => 'Language',
                'tour_overview'        => '<p>This course-travel is for all of the students that aimed to extend their education in a foreign country. If you like to get good scores in exams like IELTS and TEOEFL, here and this is for you.</p> <p>This course is operated by Cambridge Academy in the Istanbul center. Most of the tutors are native and skilled. You will have an excellent experience that is different from all of the previous English classes in your life.</p> <p>The estimated duration is two weeks for one course but you can extend it to more; if need more education or score.</p>',
                'highlights'           => [
                    [
                        'title' => 'Teaching excellence'
                    ],
                    [
                        'title' => 'English for work or Education'
                    ],
                    [
                        'title' => 'Join in a community'
                    ],
                    [
                        'title' => 'Accelerated learning'
                    ],
                    [
                        'title' => 'Native tutors'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'Day 1: Welcome to Istanbul',
                        'description' => '<p>After a short air trip to this beautiful city in the morning. The Vans are waiting for us to go to the hotel and have a short break.</p> <p>In the evening, we go to a shopping center to buy some grocery things and have familiarity with the environment and other students.</p>'
                    ],
                    [
                        'title'       => 'Day 2: Test your English. The Starting point',
                        'description' => '<p>After eating breakfast in the hotel, only a short walking necessary to arrive at the institute. On the first day, you have a short exam to determine your English level, and then according to your results join various classes.</p> <p>You should set your timetable, with attention to these classes.</p>'
                    ],
                    [
                        'title'       => 'Day 4th to 13th: The course has started, Do your best',
                        'description' => '<p>You should participate in all of your classes, with attention to your timetable. So, change your watch in the local time and be ready in place by 15 minutes.</p> <p>Almost the classes are from morning to evening. So, you have time to have a short go out and eat out some nights.</p>'
                    ],
                    [
                        'title'       => 'Day 14th: Take the test, Are you ready?',
                        'description' => '<p>Are ready for the final test? Review your notes from last night and do your exam confidently.</p> <p>Congratulations, You are level up. You can see your improvement from the starting point to here. This is the most valuable aim you can reach.</p>'
                    ],
                    [
                        'title'       => 'Day 15th: The last seconds',
                        'description' => '<p>This day is the last moment of your journey. Go out and take a picture with all of your classmates. These can be your future best friends.</p> <p>English improvement and the final test result will be the best souvenirs from this journey for yourself and your future.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'Airplane ticket (two ways)',
                    ],
                    [
                        'title' => 'Accommodation in 3 stars hotel',
                    ],
                    [
                        'title' => 'Airport transportation',
                    ],
                    [
                        'title' => '14 breakfasts',
                    ],
                    [
                        'title' => 'Course and certifications',
                    ],
                    [
                        'title' => 'Insurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'The airport transportation in Iran'
                    ],
                    [
                        'title' => 'Education materials'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "ielts-course-1.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-2.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-3.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-4.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-5.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-6.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "IELTS, preparation course",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => 'How much is the insurance for the travel for each person?',
                        'answer'   => 'About 100 billion rials (3,000 US dollars) for injured and bodily disabilities. And 2x more of that for accidental death.'
                    ],
                    [
                        'question' => 'What documents are essential for this tour package?',
                        'answer'   => 'Although a passport is the only official document for your travel, having 5-year executive management is necessary for participation.'
                    ],
                    [
                        'question' => 'How can I cancel my travel course?',
                        'answer'   => 'You should cancel your travel at least 12 days before departure. In this condition, you can pay back 70% of your payment. After this date, unfortunately, it isn’t possible to return any payment.'
                    ],
                    [
                        'question' => 'Can I travel with my husband/wife? Or my children?',
                        'answer'   => 'Yes. It’s possible to have fellow–travelers with you. But please check with Landa trip for accommodation, an airplane ticket, and so on.'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Roham',
                        'star'    => 5,
                        'comment' => 'Mission accomplished. It was nice =)',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Ava',
                        'star'    => 4,
                        'comment' => 'Splendid. So bold.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Parham',
                        'star'    => 4,
                        'comment' => 'My English improved, despite my unsatisfactory score in IELTS. If you make it longer it will be so much better.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Zeinab',
                        'star'    => 4,
                        'comment' => 'I can apply to some Canadian universities with a certificate in this course. It’s awesome.',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Language course - Landa Trip'
                        ],
                        "title"                   => "IELTS, preparation course 2022 02",
                        "start_date_tour"         => Carbon::parse('2025-02-01'),
                        "end_date_tour"           => Carbon::parse('2025-02-10'),
                        "min_capacity"            => 6,
                        "max_capacity"            => 12,
                        "days"                    => 4,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2024-08-25'),
                        "end_registration_date"   => Carbon::parse('2024-11-10'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 650,
                        "status"                  => GroupStatusEnum::canceled,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 845,
                                "ending_location"   => 845,
                                'transport'         => 'Airport transport for arrival and departure'
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Language course - Landa Trip'
                        ],
                        "title"                   => "IELTS, preparation course 2023 01",
                        "start_date_tour"         => Carbon::parse('2025-04-01'),
                        "end_date_tour"           => Carbon::parse('2025-04-10'),
                        "min_capacity"            => 6,
                        "max_capacity"            => 12,
                        "days"                    => 6,
                        "nights"                  => 5,
                        "start_registration_date" => Carbon::parse('2024-10-01'),
                        "end_registration_date"   => Carbon::parse('2024-11-10'),
                        //'accommodation'        => 'Ecolodge and camping',
                        //"price"                  => 650,
                        "status"                  => GroupStatusEnum::soldOut,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 120,
                                "ending_location"   => 122,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Language course - Landa Trip'
                        ],
                        "title"                   => "IELTS, preparation course 2023 08",
                        "start_date_tour"         => Carbon::parse('2025-08-01'),
                        "end_date_tour"           => Carbon::parse('2025-08-10'),
                        "min_capacity"            => 6,
                        "max_capacity"            => 12,
                        "days"                    => 9,
                        "nights"                  => 8,
                        "start_registration_date" => Carbon::parse('2024-03-25'),
                        "end_registration_date"   => Carbon::parse('2024-11-10'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 850,
                        "status"                  => GroupStatusEnum::draft,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 512,
                                "ending_location"   => 512,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'take-a-shot-from-the-unknown-world.webp',
                    'image_type' => 'header',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'take-a-shot-from-the-unknown-world.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'take-a-shot-from-the-unknown-world.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'language_id'          => 1,
                'title'                => 'Take a shot from the unknown world',
                'short_summary'        => 'Outdoor Practical Photography course for digital marketers and influencers',
                'city_id'              => 216,
                //'group_size'           => '12-15 people',
                ////'accommodation'        => 'Ecolodge and camping',
                //'meals'                => 'Two Breakfast, One dinner, Two lunch',
                //'transport'            => 'Charter van or bus',
                //'days'                 => 2,
                //'nights'               => 1,
                //'price'                     =>  75,
                'skills'               => 'Digital Marketing',
                'tour_overview'        => '<p>Photography is a prominent point in digital marketing. So if you need to develop your skill in it. We recommend focusing on your photography technics with a practical course, not only a theoretical one.</p> <p>Fortunately, whether you have an expensive DSLR camera or a middle smartphone, you will learn the fundamentals of composition and exposure to create content in an exploring documentary in this course.</p> <p>This course travel also goes beyond the "technical" matters and teaches how to make exciting pictures by emphasizing the aspects of Vantage Point to interpret old subjects like historic buildings and neighborhoods in new ways. </p> <p>Outdoor photography often has unexpected conditions, so discovering accessories that photographers find helpful and the types of camera bags, from mini to carry-on sized, which can help you, is also in store for you.</p>',
                'highlights'           => [
                    [
                        'title' => 'Learn about photographic techniques from professional photographers'
                    ],
                    [
                        'title' => 'Enjoy the lessons and loads of fun under the supervision of a professional guide'
                    ],
                    [
                        'title' => 'Experience the educational vocation'
                    ],
                    [
                        'title' => 'Engage in rare vacation experiences'
                    ],
                    [
                        'title' => 'Make new friends with fellow adrenaline'
                    ],
                    [
                        'title' => 'Staying in quality accommodations'
                    ],
                    [
                        'title' => 'Dive into your surroundings on fantastic excursions'
                    ],
                    [
                        'title' => 'Have the opportunity to explore a beautiful country'
                    ],
                    [
                        'title' => 'Enjoy hands-on, immersive activities'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'Day 1: Start of the adventure',
                        'description' => '<p>Our Tour starts in the early morning because we have much work to do after a short trip to Gharneh Village, a historic and beautiful village near Esfahan. We have a stopover there for breakfast and an initial section of photography courses. This location is for our rural and urban environment practices. You can try indoor locations and closed outdoor areas under the supervision of your coach.</p> <p>Afterward, we have a garment lunch in one of the historical houses and go to the village’s gardens. We try natural subjects for photography, from fauna and flora, reptiles, and mammals to birds.</p> <p>We shouldn’t lose a fantastic gathering around the fire in the night with refreshments and a light dinner in the ecolodge.</p>'
                    ],
                    [
                        'title'       => 'Day 2: Painful Return',
                        'description' => '<p>Our day starts before sunrise, so don’t miss out take amazing photos of it in the landscape of the vase desert. You can capture these magic light beams that come out among sand hills with the guidance of our coach. The Breakfast in the desert is a unique experience that you will never find it again.</p> <p>Getting Lost in the desert, far from any person or village, only by a 4-wheel drive, relax your unrest. You are free to go everywhere, in every direction. You are alone. Enjoy every moment. </p> <p>The evening is the last gathering for taking a group snapshot of our new friends. It will maintain in your memory forever.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'Charter bus',
                    ],
                    [
                        'title' => 'Accommodation in Ecotourism',
                    ],
                    [
                        'title' => '2 breakfasts, 1 dinner, 2 lunch',
                    ],
                    [
                        'title' => 'Course and certification',
                    ],
                    [
                        'title' => 'Insurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'Camera and equipment'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "kavir-2022-04-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-07.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-08.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-09.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "Take a shot from the unknown world",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => 'How much is the insurance for the travel for each person?',
                        'answer'   => 'About 100 billion rials (3,000 US dollars) for injured and bodily disabilities. And 2x more of that for accidental death.'
                    ],
                    [
                        'question' => 'What documents are essential for this tour package?',
                        'answer'   => 'Although a passport is the only official document for your travel, having 5-year executive management is necessary for participation.'
                    ],
                    [
                        'question' => 'How can I cancel my travel course?',
                        'answer'   => 'You should cancel your travel at least 12 days before departure. In this condition, you can pay back 70% of your payment. After this date, unfortunately, it isn’t possible to return any payment.'
                    ],
                    [
                        'question' => 'Can I travel with my husband/wife? Or my children?',
                        'answer'   => 'Yes. It’s possible to have fellow–travelers with you. But please check with Landa trip for accommodation, an airplane ticket, and so on.'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Mehdi',
                        'star'    => 5,
                        'comment' => 'This is an elegant travel course. You learn many tips in your fun travel. Don’t miss it.',
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'Thank you.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Ava',
                        'star'    => 5,
                        'comment' => 'I will try it again.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Zeinab',
                        'star'    => 4,
                        'comment' => 'I suggest going to it, but the spring is better.',
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'Yes, some seasons are better, but we have the air conditioning on the bus or ecolodge for your convenience.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Reza',
                        'star'    => 3,
                        'comment' => 'It has many activities that exhaust you.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Leila',
                        'star'    => 4,
                        'comment' => 'I tried it two times. Each time has a different experience.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Mohammad',
                        'star'    => 5,
                        'comment' => 'I think I\'m crying. It\'s that amazing; I can’t believe it.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Soheil',
                        'star'    => 4,
                        'comment' => 'Don’t forget to bring warm clothes in the winter and at night.',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'photography course - Landa Trip'
                        ],
                        "title"                   => "Photography 2022 02",
                        "start_date_tour"         => Carbon::parse('2025-01-01'),
                        "end_date_tour"           => Carbon::parse('2025-01-25'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 6,
                        "nights"                  => 5,
                        "start_registration_date" => Carbon::parse('2024-11-25'),
                        "end_registration_date"   => Carbon::parse('2024-12-25'),
                        //'accommodation'        => '4-Star Hotel',

                        //"price"                  => 70,
                        "status"                  => GroupStatusEnum::preRegistration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 360,
                                "ending_location"   => 361,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'photography course - Landa Trip'
                        ],
                        "title"                   => "Photography 2023 01",
                        "start_date_tour"         => Carbon::parse('2025-02-25'),
                        "end_date_tour"           => Carbon::parse('2025-02-26'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-18'),
                        //'accommodation'        => 'Ecolodge and camping',

                        //"price"                  => 70,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 50,
                                "ending_location"   => 52,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'photography course in the desert - Landa Trip'
                        ],
                        "title"                   => "Photography 2023 01",
                        "start_date_tour"         => Carbon::parse('2025-09-25'),
                        "end_date_tour"           => Carbon::parse('2025-09-26'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 20,
                        "nights"                  => 19,
                        "start_registration_date" => Carbon::parse('2025-07-25'),
                        "end_registration_date"   => Carbon::parse('2025-08-18'),
                        //'accommodation'        => '5-Star Hotel',
                        //"price"                  => 70,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 74,
                                "ending_location"   => 75,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'astronomy-and-photography-of-the-nature.webp',
                    'image_type' => 'header',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'astronomy-and-photography-of-the-nature.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'astronomy-and-photography-of-the-nature.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'language_id'          => 1,
                'title'                => 'Astronomy and photography of the nature',
                'short_summary'        => 'Gaze up at the night sky, float on the mystery of the universe with photography to keep memories.',
                'city_id'              => 1044,
                //'group_size'           => '8-14 people',
                ////'accommodation'        => 'Ecolodge and camping',
                //'meals'                => 'One Breakfast, One dinner, One lunch',
                //'transport'            => 'Private car',
                //'days'                 => 2,
                //'nights'               => 1,
                //'price'                     =>  2.95,
                'skills'               => 'Digital Marketing',
                'tour_overview'        => '<p>This tour is for all those interested people to photography and astronomy, who believe to find their fortunes in the sky or want to relieve from monotone life for at least one night.</p> <p>Look at the majestic orbit of planets around their respective stars, and try to capture wonders to behold in the universe in the frame.</p>',
                'highlights'           => [
                    [
                        'title' => 'Learning to take good shots of nature'
                    ],
                    [
                        'title' => 'Learning to color and contract balancing in the sunrise and sunshine'
                    ],
                    [
                        'title' => 'Taking pictures with the tripod in the nature'
                    ],
                    [
                        'title' => 'Adjustment of brightness and contrast in dark environments'
                    ],
                    [
                        'title' => 'Find the best dates from the astrology'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'Day 1: Start a good short trip',
                        'description' => '<p>Our travel starts from outside of Esfahan city on the route of Abyaneh. It takes about two hours to arrive there, then we have a short class for an introduction to photography, tools, and requirements. </p> <p>After that our photography workshop, will focus on shooting nature, animals, and nature objects. Have much practice with panoramic and long-shot framing. We have a short lunch break, and we continue to photoshoot practicing before the sunshine. We plan to take great photos of sunshine and the blue-red sky.</p> <p>After a short and early dinner in the early hours of the night, we will be outside, in the woods until sunrise. The coach helped students to put in the tripods and camera and capture wonder full images from the zodiac system planets, and the other stars.</p>'
                    ],
                    [
                        'title'       => 'Day 2: Mid-night is everything',
                        'description' => '<p>This day started from the last night’s outdoor activities. We have a short nap in the morning after sunrise and a late breakfast before noon. All of the students should gather and show their pictures on the video projector and the coach gives a comment about them until lunch.</p> <p>Having a delicious lunch changes your mood and you will be ready to come back with a lot of new and sweet memories and knowledge.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'Accommodation in the ecolodge',
                    ],
                    [
                        'title' => 'One breakfast',
                    ],
                    [
                        'title' => 'One lunch',
                    ],
                    [
                        'title' => 'One Dinner',
                    ],
                    [
                        'title' => 'Certifications',
                    ],
                    [
                        'title' => 'Insurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'Transportation'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "kashan-2023-01-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-07.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-08.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-09.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "Astronomy and photography of the nature",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => 'How much is the insurance for the travel for each person?',
                        'answer'   => 'About 100 billion rials (3,000 US dollars) for injured and bodily disabilities. And 2x more of that for accidental death.'
                    ],
                    [
                        'question' => 'What documents are essential for this tour package?',
                        'answer'   => 'Although a passport is the only official document for your travel, having 5-year executive management is necessary for participation.'
                    ],
                    [
                        'question' => 'How can I cancel my travel course?',
                        'answer'   => 'You should cancel your travel at least 12 days before departure. In this condition, you can pay back 70% of your payment. After this date, unfortunately, it isn’t possible to return any payment.'
                    ],
                    [
                        'question' => 'Can I travel with my husband/wife? Or my children?',
                        'answer'   => 'Yes. It’s possible to have fellow–travelers with you. But please check with Landa trip for accommodation, an airplane ticket, and so on.'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Leila',
                        'star'    => 5,
                        'comment' => 'It was a truly unforgettable experience for me.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Ali',
                        'star'    => 4,
                        'comment' => 'I really enjoyed this travel. It provides a lot of valuable information for me.',
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'Thank you so much.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Ava',
                        'star'    => 5,
                        'comment' => 'I recently went on a tour with Landa Trip and it was amazing! The guide was knowledgeable and made the experience so much fun.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Sara',
                        'star'    => 3,
                        'comment' => 'This was my first time going on a tour with Landa Trip and I have to say, it exceeded all of my expectations except on the meals.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Soheil',
                        'star'    => 4,
                        'comment' => 'I went on this tour with my family and we all agreed that it was the highlight of our vacation.',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Nature Photography course - Landa Trip'
                        ],
                        "title"                   => "Nature Photography 2022 03",
                        "start_date_tour"         => Carbon::parse('2025-01-10'),
                        "end_date_tour"           => Carbon::parse('2025-01-30'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2024-11-25'),
                        "end_registration_date"   => Carbon::parse('2024-12-02'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 2.95,
                        "status"                  => GroupStatusEnum::canceled,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 85,
                                "ending_location"   => 86,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Nature Photography course - Landa Trip'
                        ],
                        "title"                   => "Nature Photography 2023 01",
                        "start_date_tour"         => Carbon::parse('2025-02-19'),
                        "end_date_tour"           => Carbon::parse('2025-02-20'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 6,
                        "nights"                  => 5,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-15'),
                        //'accommodation'        => '4-Star Hotel',

                        //"price"                  => 2.95,
                        "status"                  => GroupStatusEnum::startSoon,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 52,
                                "ending_location"   => 51,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Nature Photography course - Landa Trip'
                        ],
                        "title"                   => "Nature Photography 2023 10",
                        "start_date_tour"         => Carbon::parse('2025-01-01'),
                        "end_date_tour"           => Carbon::parse('2025-01-20'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 14,
                        "nights"                  => 15,
                        "start_registration_date" => Carbon::parse('2024-11-25'),
                        "end_registration_date"   => Carbon::parse('2024-12-15'),
                        //'accommodation'        => 'Ecolodge and camping',
                        //"price"                  => 3.5,
                        "status"                  => GroupStatusEnum::onGoing,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 400,
                                "ending_location"   => 401,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ],
            ],
            [
                'header_pic'           => [
                    'url'        => 'tech-and-invest-in-oman-a-journey-of-innovation-and-opportunity.webp',
                    'image_type' => 'header',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'tech-and-invest-in-oman-a-journey-of-innovation-and-opportunity.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'tech-and-invest-in-oman-a-journey-of-innovation-and-opportunity.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'language_id'          => 1,
                'title'                => 'Tech and Invest in Oman: A Journey of Innovation and Opportunity',
                'short_summary'        => 'Discover the Future of Investment and Technology in Oman: A Journey Through Innovation Hubs and Economic Zones',
                'city_id'              => 13,
                //'group_size'           => '15-20 people',
                ////'accommodation'        => '4-star hotel',
                //'meals'                => '6 Breakfast, One dinner',
                //'transport'            => 'Airport and daily transfer followed the itinerary',
                //'days'                 => 7,
                //'nights'               => 6,
                //'price'                     =>  2.95,
                'skills'               => 'Business Management',
                'tour_overview'        => '<p>Embark on a 6-night, 7-day journey through Oman\'s investment and tech landscape. Discover the country\'s rich culture and architecture by visiting the Sultan Qaboos Grand Mosque and Al Alam Palace, and then dive into Oman\'s rapidly growing tech industry by meeting with representatives from Oman Investment Authority and Oman Technology Fund.</p> <p>Learn about the business landscape in Oman by visiting the National Business Centre, and explore the benefits of the Sohar Free Zone. Experience world-class performances at the Royal Opera Oman and learn about Oman\'s marine conservation efforts at the Aqua Center.</p> <p>Finally, indulge in shopping, dining, and entertainment at the Mall of Muscat before taking home unforgettable memories of Oman\'s unique blend of tradition and modernity. </p>',
                'highlights'           => [
                    [
                        'title' => 'Visit the largest mosques in the world'
                    ],
                    [
                        'title' => 'Presenting numerous investment opportunities'
                    ],
                    [
                        'title' => 'Visit Oman business hub centers'
                    ],
                    [
                        'title' => 'Oman Investment Authority and Oman Technology Fund'
                    ],
                    [
                        'title' => 'Shopping from the best markets in Oman'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'Day 1: Awe-Inspiring Mosques and Regal Palaces',
                        'description' => '<p>The journey begins with a morning flight from Tehran to Muscat, the capital city of Oman.</p> <p>Upon arrival, you\'ll be escorted to your hotel for check-in and a short rest, it will be started by exploring the grandeur of Sultan Qaboos Grand Mosque, which is one of the largest mosques in the world. the intricate details of the architecture are admirable and learned about the history and culture of Oman\'s Islamic faith.</p> <p>In the evening, the beauty of Al Alam Palace, the ceremonial palace of the Sultan of Oman is waiting for you, which is located in the heart of Muscat, the palace features stunning gold and blue facade and offers a spectacular view of the harbor.</p>'
                    ],
                    [
                        'title'       => 'Day 2: Discover Oman\'s Investment Gems',
                        'description' => '<p>After breakfast at the hotel, visit the Oman Investment Authority, a government agency that facilitates investment in Oman. Meet with representatives to learn about investment opportunities in the country and explore the possibilities for your business. After that, visit the Oman Technology Fund, a venture capital fund that invests in technology startups in Oman and the region.</p> <p>You\'ll get to meet with local entrepreneurs and learn about the cutting-edge technologies being developed in Oman.</p>'
                    ],
                    [
                        'title'       => 'Day 3: Empowering Entrepreneurs',
                        'description' => '<p>Today, you\'ll visit the National Business Centre, a hub that offers support and resources to entrepreneurs and small businesses.</p><p>You\'ll have the opportunity to attend workshops and networking events and learn about the business landscape in Oman. You\'ll also get to meet with local entrepreneurs and hear their stories of success.</p>'
                    ],
                    [
                        'title'       => 'Day 4: Sohar Free Zone: Where Investment Meets Opportunity',
                        'description' => '<p>Today, you\'ll drive to Sohar, located on the northern coast of Oman, to explore the Sohar Free Zone, a designated economic zone that offers tax incentives and other benefits to businesses.</p><p>You\'ll get to meet with representatives from various industries and learn about investment opportunities in the area. You\'ll also have the chance to visit the Sohar Industrial Port and see the various industries in action.</p>'
                    ],
                    [
                        'title'       => 'Day 5: Art and Oceanic Wonders',
                        'description' => '<p>Today\'s first stop is the Royal Opera Oman, a grand performing arts center that hosts various shows and performances. Be captivated by the stunning architecture and world-class performances.</p><p>After that, continue to the Aqua Center, an educational and research center that showcases Oman\'s unique marine life.</p><p>You\'ll learn about Oman\'s efforts in marine conservation and have the chance to interact with marine animals.</p>'
                    ],
                    [
                        'title'       => 'Day 6: Indulge in Luxuries at the Mall of Muscat',
                        'description' => '<p>Today, you\'ll have a free day to explore the city at your own pace. Visit the Mall of Muscat, one of the largest malls in Oman, and indulge in shopping, dining, and entertainment. The mall features high-end luxury brands, a variety of dining options, and a state-of-the-art cinema.</p>'
                    ],
                    [
                        'title'       => 'Day 7: Lasting Memories and Departure',
                        'description' => '<p>Spend your final hours at the Mall of Muscat before transferring to the International Airport of Muscat for your flight back to Tehran. Take with you unforgettable memories of Oman\'s investment and tech marvels.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'Airport and daily transfer followed the itinerary',
                    ],
                    [
                        'title' => 'Accommodation in 4-star hotel',
                    ],
                    [
                        'title' => '6 breakfasts, 1 dinner',
                    ],
                    [
                        'title' => 'Insurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'Local translator'
                    ],
                    [
                        'title' => 'Law and legal consultant'
                    ],
                    [
                        'title' => 'Financial and business consultant'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "kavir-2022-04-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-07.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-08.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-09.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "Tech and Invest in Oman: A Journey of Innovation and Opportunity",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => 'How much is the insurance for the travel for each person?',
                        'answer'   => 'About 100 billion rials (3,000 US dollars) for injured and bodily disabilities. And 2x more of that for accidental death.'
                    ],
                    [
                        'question' => 'What documents are essential for this tour package?',
                        'answer'   => 'Although a passport is the only official document for your travel, having 5-year executive management is necessary for participation.'
                    ],
                    [
                        'question' => 'How can I cancel my travel course?',
                        'answer'   => 'You should cancel your travel at least 12 days before departure. In this condition, you can pay back 70% of your payment. After this date, unfortunately, it isn’t possible to return any payment.'
                    ],
                    [
                        'question' => 'Can I travel with my husband/wife? Or my children?',
                        'answer'   => 'Yes. It’s possible to have fellow–travelers with you. But please check with Landa trip for accommodation, an airplane ticket, and so on.'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Tech and Invest in Oman'
                        ],
                        "title"                   => "Tech and Invest in Oman in summer",
                        "start_date_tour"         => Carbon::parse('2025-01-13'),
                        "end_date_tour"           => Carbon::parse('2025-01-19'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2024-12-20'),
                        "end_registration_date"   => Carbon::parse('2024-12-30'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 650,
                        "status"                  => GroupStatusEnum::completed,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 520,
                                "ending_location"   => 522,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 1,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Tech and Invest in Oman'
                        ],
                        "title"                   => "Tech and Invest in Oman in autumn",
                        "start_date_tour"         => Carbon::parse('2025-09-13'),
                        "end_date_tour"           => Carbon::parse('2025-09-19'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 9,
                        "nights"                  => 8,
                        "start_registration_date" => Carbon::parse('2024-10-25'),
                        "end_registration_date"   => Carbon::parse('2024-11-02'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 720,
                        "status"                  => GroupStatusEnum::startSoon,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 98,
                                "ending_location"   => 99,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ]
            ],


            // French
            [
                'header_pic'           => [
                    'url'        => 'ielts-preparation-course.webp',
                    'image_type' => 'header',
                    'alt'        => 'IELTS, preparation course - Language - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'ielts-preparation-course.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'IELTS, preparation course - Language - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'ielts-preparation-course.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'IELTS, preparation course - Language - Landa Trip'
                ],
                'language_id'          => 2,
                'title'                => 'IELTS, preparation course',
                'short_summary'        => "L'IELTS est un examen standard pour reconnaître la compétence en langue anglaise. Il comporte une variété de compétences et de questions qui nécessitent de la pratique et des astuces pour y répondre en peu de temps. Ce cours vous apprend cela auprès des meilleurs examinateurs.",
                'city_id'              => 2759,
                //'group_size'           => '10-12 people',
                ////'accommodation'        => '3-Star Hotel',
                //'meals'                => '14 Breakfast',
                //'transport'            => 'Airport transport for arrival and departure',
                //'days'                 => 15,
                //'nights'               => 14,
                //'price'                     =>  650,
                'skills'               => 'Language',
                'tour_overview'        => "<p>Ce cours de voyage est destiné à tous les étudiants qui souhaitent poursuivre leurs études dans un pays étranger. Si vous souhaitez obtenir de bons scores aux examens tels que l'IELTS et le TOEFL, ce cours est pour vous.</p><p>Ce cours est dispensé par l'Académie de Cambridge au centre d'Istanbul. La plupart des enseignants sont des locuteurs natifs et qualifiés. Vous aurez une expérience excellente et différente de toutes les classes d'anglais précédentes de votre vie.</p><p>La durée estimée est de deux semaines pour un cours, mais vous pouvez la prolonger si vous avez besoin de plus d'éducation ou d'un meilleur score. </p>",
                'highlights'           => [
                    [
                        'title' => 'Excellence en Enseignement'
                    ],
                    [
                        'title' => "Anglais pour le travail ou l'éducation"
                    ],
                    [
                        'title' => 'Rejoindre une communauté'
                    ],
                    [
                        'title' => 'Apprentissage accéléré'
                    ],
                    [
                        'title' => 'Tuteurs natifs'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'Jour 1 : bienvenue à istanbul',
                        'description' => "<p>Après un court voyage en avion vers cette belle ville le matin, des vans nous attendent pour nous conduire à l'hôtel et nous permettre de prendre une courte pause.</p> <p>Le soir, nous nous rendons dans un centre commercial pour acheter des courses et nous familiariser avec l'environnement et les autres étudiants.</p>"
                    ],
                    [
                        'title'       => 'Jour 2 : testez votre anglais,le point de départ',
                        'description' => "<p>Après avoir pris le petit déjeuner à l'hôtel, il ne faut qu'une courte marche pour arriver à l'institut. Le premier jour, vous passez un court examen pour déterminer votre niveau d'anglais, puis en fonction de vos résultats, vous rejoignez diverses classes</p> <p>Vous devez établir votre emploi du temps en faisant attention à ces classes.</p>"
                    ],
                    [
                        'title'       => 'Jour 4 au 13 :le cours a commencé , fais de ton mieux',
                        'description' => "<p>Vous devriez participer à toutes vos classes, en faisant attention à votre emploi du temps. Ainsi, changez votre montre à l'heure locale et soyez prêt sur place 15 minutes avant le début de chaque cours.</p> <p>La plupart des cours ont lieu du matin jusqu'au soir, vous aurez donc le temps de sortir et de dîner à l'extérieur certains soirs.</p>"
                    ],
                    [
                        'title'       => 'Jour 14 :passer un test,Es-vous prêt',
                        'description' => "<p>Êtes-vous prêt pour l'examen final ? Révisez vos notes de la nuit dernière et passez votre examen en toute confiance</p> <p>Félicitations ! Vous avez progressé et vous pouvez constater votre amélioration depuis le début du programme. Atteindre cet objectif est la plus grande réussite.</p>"
                    ],
                    [
                        'title'       => 'Jour 15 : La dernière seconde.',
                        'description' => "<p>C'est le dernier jour de votre voyage. Sortez et prenez une photo avec tous vos camarades de classe. Ceux-ci pourraient devenir vos meilleurs amis dans l'avenir.</p> <p>L'amélioration de votre anglais et le résultat de l'examen final seront les meilleurs souvenirs de ce voyage pour vous et votre avenir.</p>"
                    ]
                ],
                'includes'             => [
                    [
                        'title' => "billet d'avion",
                    ],
                    [
                        'title' => 'Hébergement en hôtel 3 étoiles',
                    ],
                    [
                        'title' => 'Transport aéroport',
                    ],
                    [
                        'title' => '14 petits déjeuners',
                    ],
                    [
                        'title' => 'Cours et certifications',
                    ],
                    [
                        'title' => 'Assurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'le transport aéroport en iran'
                    ],
                    [
                        'title' => 'materiel de formation'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "ielts-course-1.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-2.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-3.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-4.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-5.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-6.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         =>
                //                    [
                //                        [
                //
                //                            'title'            => "Cambridge Academy certificate",
                //                            'certificate_type' => "Certification of participation"
                //
                //                        ]
                //                    ],
                'terms_and_conditions' => [
                    [
                        'question' => "Combien coûte l'assurance pour le voyage pour chaque personne?",
                        'answer'   => 'Environ 100 milliards de rials (3 000 dollars américains) pour les blessés et les handicaps corporels. Et 2 fois plus en cas de décès accidentel.'
                    ],
                    [
                        'question' => 'Quels documents sont indispensables pour ce voyage organisé?',
                        'answer'   => "Bien que votre passeport soit le seul document officiel pour votre voyage, il est nécessaire d'avoir 5 ans de direction exécutive pour l'entreprise."
                    ],
                    [
                        'question' => 'Comment annuler des cours de voyage?',
                        'answer'   => "Vous devez annuler votre voyage au moins 12 jours avant le départ.Dans cette condition, vous pouvez rembourser 70% de votre paiement.Après cette date, malheureusement, il n'est plus possible de retourner un paiement."
                    ],
                    [
                        'question' => 'Puis-je voyager avec mon mari/ma femme ?ou mes enfants?',
                        'answer'   => "Oui. Il est possible d'avoir des compagnons de route avec vous.Mais s'il vous plaît vérifier avec Landa trip pour l'hébergement, un billet d'avion, etc."
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Roham',
                        'star'    => 5,
                        'comment' => "Mission accomplie. C'était agréable =)",
                        'replies' => []
                    ],
                    [
                        'name'    => 'Ava',
                        'star'    => 4,
                        'comment' => 'Splendide. Tellement audacieux',
                        'replies' => []
                    ],
                    [

                        'name'    => 'Parham',
                        'star'    => 4,
                        'comment' => "Mon anglais s'est amélioré malgré mon score insatisfaisant à l'IELTS. Si vous développez davantage, cela sera encore mieux.",
                        'replies' => []
                    ],
                    [
                        'name'    => 'Zeinab',
                        'star'    => 4,
                        'comment' => "Je peux postuler à certaines universités canadiennes avec un certificat de ce cours. C'est génial.",
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 2,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Language course - Landa Trip'
                        ],
                        "title"                   => "IELTS, preparation course 2022 02",
                        "start_date_tour"         => Carbon::parse('2025-02-01'),
                        "end_date_tour"           => Carbon::parse('2025-02-10'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 3,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-10'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 650,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 800,
                                "ending_location"   => 802,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 2,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Language course - Landa Trip'
                        ],
                        "title"                   => "IELTS, preparation course 2023 01",
                        "start_date_tour"         => Carbon::parse('2025-04-01'),
                        "end_date_tour"           => Carbon::parse('2025-04-10'),
                        "min_capacity"            => 6,
                        "max_capacity"            => 12,
                        "days"                    => 9,
                        "nights"                  => 8,
                        "start_registration_date" => Carbon::parse('2025-02-25'),
                        "end_registration_date"   => Carbon::parse('2025-03-10'),
                        //'accommodation'        => '3-Star Hotel',

                        //"price"                  => 650,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 920,
                                "ending_location"   => 920,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'take-a-shot-from-the-unknown-world.webp',
                    'image_type' => 'header',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'take-a-shot-from-the-unknown-world.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'take-a-shot-from-the-unknown-world.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'language_id'          => 2,
                'title'                => 'Prenez des photos du monde inconnu',
                'short_summary'        => 'Cours pratique de photographie en plein air pour les spécialistes du marketing numérique et les influenceurs',
                'city_id'              => 12,
                //'group_size'           => '12-15 people',
                ////'accommodation'        => 'Ecolodge and camping',
                //'meals'                => 'Two Breakfast, One dinner, Two lunch',
                //'transport'            => 'Charter van or bus',
                //'days'                 => 2,
                //'nights'               => 1,
                //'price'                     =>  75,
                'skills'               => 'Digital Marketing',
                'tour_overview'        => "<p>La photographie est un élément important du marketing numérique. Si vous avez besoin de développer vos compétences dans ce domaine, nous vous recommandons de vous concentrer sur les techniques de photographie avec un cours pratique, pas seulement théorique.</p> <p>Heureusement, que vous possédiez un appareil photo reflex numérique coûteux ou un smartphone moyen, vous apprendrez les fondamentaux de la composition et de l'exposition pour créer du contenu dans une approche documentaire exploratoire dans ce cours.</p> <p>Ce cours de voyage se concentre également sur des aspects qui vont au-delà des questions 'techniques' et enseigne comment créer des photos excitantes en mettant l'accent sur les aspects du point de vue pour interpréter des sujets anciens tels que les bâtiments historiques et les quartiers de nouvelles manières </p><p>La photographie en extérieur implique souvent des conditions inattendues, donc la découverte des accessoires utiles aux photographes ainsi que les types de sacs pour appareils photo, des mini-sacs aux sacs de cabine, qui peuvent vous aider, est également prévue pour vous dans ce cours.




                 </p>",
                'highlights'           => [
                    [
                        'title' => 'En savoir plus sur les techniques photographiques de photographes professionnels'
                    ],
                    [
                        'title' => "Profitez de cours et de beaucoup de plaisir sous la supervision d'un guide professionnel"
                    ],
                    [
                        'title' => 'Expérimenter la vocation éducative'
                    ],
                    [
                        'title' => 'Vivez des expériences de vacances rares'
                    ],
                    [
                        'title' => 'Faites-vous de nouveaux amis'
                    ],
                    [
                        'title' => 'Séjourner dans des hébergements de qualité'
                    ],
                    [
                        'title' => 'Vivez des expériences de vacances rares'
                    ],
                    [
                        'title' => "Avoir l'opportunité d'explorer un beau pays"
                    ],
                    [
                        'title' => "Profitez d'activités pratiques et immersives"
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => "Jour 1 commencez l'aventure",
                        'description' => "<p>Notre voyage commence tôt le matin car nous avons beaucoup de travail à faire après un court voyage jusqu'au village de Gharneh, un village historique et magnifique près d'Ispahan. Nous y faisons une pause pour le petit-déjeuner et une première session de cours de photographie. Cet endroit est idéal pour nos pratiques environnementales rurales et urbaines. Vous pouvez essayer des lieux intérieurs et des zones extérieures fermées sous la supervision de votre coach.</p> <p>Ensuite, nous avons un déjeuner traditionnel dans l'une des maisons historiques et nous partons pour les jardins du village. Nous essayons des sujets naturels pour la photographie, allant de la faune et la flore, aux reptiles et aux mammifères, en passant par les oiseaux.</p><p>Nous ne devrions pas manquer une fantastique soirée autour du feu avec des rafraîchissements et un dîner léger dans l'écolodge.</p>'
                    ],
                    [
                        'title'       => 'Jour 2 retour douloureux',
                        'description' => '<p>Notre journée commence avant le lever du soleil, alors ne manquez pas l'occasion de prendre des photos incroyables dans le paysage du désert de Vase. Vous pouvez capturer ces faisceaux de lumière magiques qui émergent parmi les dunes de sable avec l'aide de notre coach. Le petit-déjeuner dans le désert est une expérience unique que vous ne trouverez nulle part ailleurs. </p> <p>Se perdre dans le désert, loin de toute personne ou village, seulement , apaise votre agitation. Vous êtes libre d'aller partout, dans toutes les directions. Vous êtes seul. Profitez de chaque moment.</p> <p>Le soir est la dernière occasion de prendre une photo de groupe avec nos nouveaux amis. Cela restera gravé dans votre mémoire pour toujours.</p>"
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'Autobus affrété',
                    ],
                    [
                        'title' => 'Hébergement en écotourisme',
                    ],
                    [
                        'title' => '2 petits-déjeuners, 1 dîner, 2 déjeuners',
                    ],
                    [
                        'title' => 'Cours et certification',
                    ],
                    [
                        'title' => 'Assurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'Caméra et équipement'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "kavir-2022-04-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-07.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-08.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-09.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => 'Landa Trip Certification',
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => "Combien coûte l'assurance pour le voyage pour chaque personne?",
                        'answer'   => 'Environ 100 milliards de rials (3 000 dollars américains) pour les blessés et les handicaps corporels. Et 2 fois plus en cas de décès accidentel.'
                    ],
                    [
                        'question' => 'Quels documents sont indispensables pour ce voyage organisé?',
                        'answer'   => "Bien que votre passeport soit le seul document officiel pour votre voyage, il est nécessaire d'avoir 5 ans de direction exécutive pour l'entreprise."
                    ],
                    [
                        'question' => 'Comment annuler des cours de voyage?',
                        'answer'   => "Vous devez annuler votre voyage au moins 12 jours avant le départ.Dans cette condition, vous pouvez rembourser 70% de votre paiement.Après cette date, malheureusement, il n'est plus possible de retourner un paiement."
                    ],
                    [
                        'question' => 'Puis-je voyager avec mon mari/ma femme ?ou mes enfants?',
                        'answer'   => "Oui. Il est possible d'avoir des compagnons de route avec vous.Mais s'il vous plaît vérifier avec Landa trip pour l'hébergement, un billet d'avion, etc."
                    ],
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Mehdi',
                        'star'    => 5,
                        'comment' => "C'est un cours de voyage élégant. Vous apprenez de nombreux conseils lors de votre voyage amusant. Ne le manquez pas.",
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'Merci :)'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Ava',
                        'star'    => 5,
                        'comment' => 'Je vais réessayer.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Zeinab',
                        'star'    => 4,
                        'comment' => "Je suggère d'y aller, mais le printemps est préférable.",
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => "Oui, certaines saisons sont meilleures, mais nous avons la climatisation dans le bus ou l'écolodge pour votre confort."
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Reza',
                        'star'    => 3,
                        'comment' => "Il y a beaucoup d'activités qui peuvent vous épuiser.",
                        'replies' => []
                    ],
                    [
                        'name'    => 'Leila',
                        'star'    => 4,
                        'comment' => "That's great to hear! It's always exciting to have unique experiences every time you participate in something.",
                        'replies' => []
                    ],
                    [
                        'name'    => 'Mohammad',
                        'star'    => 5,
                        'comment' => "c'est genial pour moi",
                        'replies' => []
                    ],
                    [
                        'name'    => 'Soheil',
                        'star'    => 4,
                        'comment' => "N'oubliez pas d'apporter des vêtements chauds en hiver et la nuit.",
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 2,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'photography course - Landa Trip'
                        ],
                        "title"                   => "Photography 2022 02",
                        "start_date_tour"         => Carbon::parse('2025-12-01'),
                        "end_date_tour"           => Carbon::parse('2025-12-02'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 5,
                        "nights"                  => 6,
                        "start_registration_date" => Carbon::parse('2025-10-25'),
                        "end_registration_date"   => Carbon::parse('2025-11-25'),
                        //'accommodation'        => 'Ecolodge and camping',
                        //"price"                  => 35,
                        "status"                  => GroupStatusEnum::preRegistration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 785,
                                "ending_location"   => 789,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 2,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'photography course - Landa Trip'
                        ],
                        "title"                   => "Photography 2023 01",
                        "start_date_tour"         => Carbon::parse('2023-02-25'),
                        "end_date_tour"           => Carbon::parse('2023-02-26'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 7,
                        "nights"                  => 6,
                        "start_registration_date" => Carbon::parse('2023-01-25'),
                        "end_registration_date"   => Carbon::parse('2023-02-18'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 35,
                        "status"                  => GroupStatusEnum::startSoon,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 452,
                                "ending_location"   => 453,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 2,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'photography course - Landa Trip'
                        ],
                        "title"                   => "Photography 2023 11",
                        "start_date_tour"         => Carbon::parse('2023-11-25'),
                        "end_date_tour"           => Carbon::parse('2023-11-26'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 4,
                        "nights"                  => 3,
                        "start_registration_date" => Carbon::parse('2023-09-25'),
                        "end_registration_date"   => Carbon::parse('2023-10-18'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 40,
                        "status"                  => GroupStatusEnum::onGoing,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 630,
                                "ending_location"   => 631,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'seo-tips-and-tricks.webp',
                    'image_type' => 'header',
                    'alt'        => 'SEO, Tips and Tricks - Information Technology, Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'seo-tips-and-tricks.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'SEO, Tips and Tricks - Information Technology, Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'seo-tips-and-tricks.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'SEO, Tips and Tricks - Information Technology, Digital Marketing - Landa Trip'
                ],
                'language_id'          => 2,
                'title'                => 'SEO, trucs et astuces',
                'short_summary'        => "Comprendre les petits conseils utiles sur l'optimisation des moteurs de recherche et les astuces pratiques pour améliorer vos sites Web",
                'city_id'              => 11,
                //'group_size'           => '8-14 people',
                ////'accommodation'        => '4-Star Hotel',
                //'meals'                => '4 Breakfast, 2 lunch, and 1 dinner',
                //'transport'            => 'Airport transport for arrival and departure',
                //'days'                 => 5,
                //'nights'               => 4,
                //'price'                     =>  195,
                'skills'               => 'Information Technology, Digital Marketing',
                'tour_overview'        => "<p>De nos jours, Internet est l'outil le plus important pour présenter et vendre presque tous les produits. Et les sites web sont en première ligne de cette tendance. Si vous souhaitez avoir un site web populaire pour promouvoir vos services et vos produits, les conseils en matière de référencement (SEO) sont essentiels.</p> <p>Le SEO est l'abréviation de Search Engine Optimization, qui correspond au processus visant à obtenir une meilleure position dans les résultats des moteurs de recherche pour des mots-clés ciblés dans des zones et des marchés spécifiques.</p> <p>Dans ce cours de voyage, nous apprenons des astuces et des techniques pour utiliser les moteurs de recherche des robots à notre avantage. Nous apprenons ce qu'il faut faire sur nos sites web et comment trouver et planifier l'optimisation pour les moteurs de recherche.</p>",
                'highlights'           => [
                    [
                        'title' => 'Découvrir les algorithmes de Google'
                    ],
                    [
                        'title' => 'Une analyse concurrentielle sur une page web '
                    ],
                    [
                        'title' => 'Comprendre le fonctionnement du référencement des moteurs de recherche'
                    ],
                    [
                        'title' => "Soumettez votre site Web à Google et facilitez l'indexation de votre site par les moteurs de recherche"
                    ],
                    [
                        'title' => 'Recherche de mots clés'
                    ],
                    [
                        'title' => 'Analyse de la vitesse des pages'
                    ],
                    [
                        'title' => 'Apprenez à créer des backlinks à partir de ressources vérifiées et fiables'
                    ],
                    [
                        'title' => 'Évitez les pratiques de SEO négatives.'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => "Jour 1:Bienvenue sur l'île de kish",
                        'description' => "<p>Après un court vol vers l'île de Kish le matin, nous nous transférerons et nous enregistrerons à l'hôtel. En soirée, nous aurons du temps libre pour une rencontre conviviale dans l'un des charmants cafés près de la plage de Legacy. Tous les étudiants et le tuteur se présenteront les uns aux autres pour entamer un voyage amical et éducatif.</p>"
                    ],
                    [
                        'title'       => 'Jour 2 :Le cours est prêt à continuer,Es-vous prêt',
                        'description' => "<p>Après avoir pris le petit-déjeuner à l'hôtel, il suffit d'une courte marche pour arriver à la salle de classe. Le cours commence à 9h00 et vous avez deux courtes pauses et une pause déjeuner jusqu'à 17h00, heure de la fin des cours.</p> <p>Dans cette classe, vous apprendrez ce qu'est le référencement (SEO), pourquoi l'utiliser et comment les algorithmes de Google fonctionnent.</p> <p>Il est logique que le contenu théorique soit plus abondant que la pratique le premier jour, mais vous devriez les assimiler.</p>"
                    ],
                    [
                        'title'       => "Jour 3:Le début de l'analyse pratique",
                        'description' => "<p>Comme hier, l'heure de cours est la même, mais le contenu passe de la théorie et des diaporamas à une analyse pratique des entreprises. Vos entreprises auront une analyse concurrentielle et de mots-clés en coopération avec les autres participants. C'est l'un des avantages uniques de ce cours par rapport à d'autres similaires. </p> <p>Vous devriez prendre note des commentaires et les traiter après le cours.</p>"
                    ],
                    [
                        'title'       => 'Jour 4:Appliquer vos connaissances',
                        'description' => "<p>C'est le dernier jour de votre cours. Le cours est à temps partiel, de 9h30 à 13h00, et se terminera avant l'heure du déjeuner.</p> <p>Il est temps d'appliquer vos nouvelles connaissances de manière pratique à votre site web d'entreprise dans la salle de classe avec votre ordinateur portable ou votre PC.</p>"
                    ],
                    [
                        'title'       => 'Jour 5 : La dernière seconde',
                        'description' => "<p>Après le petit-déjeuner, tous les étudiants voyageurs sont prêts à partir à l'aéroport.</p> <p>Une photo de groupe, de nouveaux amis, de nouvelles connexions et des certifications seront les meilleurs souvenirs de ce voyage pour vous-même et votre entreprise.</p>"
                    ]
                ],
                'includes'             => [
                    [
                        'title' => "Billet d'avion (aller-retour)",
                    ],
                    [
                        'title' => 'Hébergement en hôtel 4 étoiles',
                    ],
                    [
                        'title' => 'Transport aéroport',
                    ],
                    [
                        'title' => '4 petits déjeuners',
                    ],
                    [
                        'title' => '2 déjeuners',
                    ],
                    [
                        'title' => '1 dîner',
                    ],
                    [
                        'title' => 'Cours et certifications',
                    ],
                    [
                        'title' => 'Assurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => "•	Le transport vers l'aéroport"
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "seo-course-1.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-2.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-3.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-4.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-5.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-6.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-7.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-8.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-9.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-13.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-14.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-15.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-16.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-17.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-18.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "SEO, Tips and Tricks",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => "Combien coûte l'assurance pour le voyage pour chaque personne?",
                        'answer'   => 'Environ 100 milliards de rials (3 000 dollars américains) pour les blessés et les handicaps corporels. Et 2 fois plus en cas de décès accidentel.'
                    ],
                    [
                        'question' => 'Quels documents sont indispensables pour ce voyage organisé?',
                        'answer'   => 'Although a passport is the only official document for your travel, having 5-year executive management is necessary for participation.'
                    ],
                    [
                        'question' => 'Comment annuler des cours de voyage?',
                        'answer'   => "Vous devez annuler votre voyage au moins 12 jours avant le départ.Dans cette condition, vous pouvez rembourser 70% de votre paiement.Après cette date, malheureusement, il n'est plus possible de retourner un paiement."
                    ],
                    [
                        'question' => 'Puis-je voyager avec mon mari/ma femme ?ou mes enfants?',
                        'answer'   => "Oui. Il est possible d'avoir des compagnons de route avec vous.Mais s'il vous plaît vérifier avec Landa trip pour l'hébergement, un billet d'avion, etc."
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Maryam',
                        'star'    => 5,
                        'comment' => 'Je comprends le processus de classement dans les résultats de Google grâce à ce cours. Je commencerai à appliquer tous les conseils dans mon entreprise en ligne dès demain.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Mohammad',
                        'star'    => 4,
                        'comment' => "Maintenant, je peux ajouter le service de référencement (SEO) à mes services de création de sites web. J'aimerais suivre un cours plus approfondi sur le sujet.",
                        'replies' => []
                    ],
                    [
                        'name'    => 'Mehdi',
                        'star'    => 5,
                        'comment' => "Extrêmement excellent ! Je le recommande à tous les propriétaires d'entreprises en ligne.",
                        'replies' => []
                    ],
                    [
                        'name'    => 'Leila',
                        'star'    => 3,
                        'comment' => 'Expérience très élégante.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Reza',
                        'star'    => 3,
                        'comment' => 'Cette atmosphère a directement navigué dans mon cœur.',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 3,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'SEO Tips and Tricks - Landa Trip'
                        ],
                        "title"                   => "SEO, Tips and Tricks 2022 03",
                        "start_date_tour"         => Carbon::parse('2025-02-01'),
                        "end_date_tour"           => Carbon::parse('2025-02-10'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 20,
                        "days"                    => 6,
                        "nights"                  => 5,
                        "start_registration_date" => Carbon::parse('2024-01-02'),
                        "end_registration_date"   => Carbon::parse('2024-01-18'),
                        //'accommodation'        => '3-Star Hotel',
                        //"price"                  => 195,
                        "status"                  => GroupStatusEnum::canceled,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 780,
                                "ending_location"   => 782,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 3,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'SEO Tips and Tricks - Landa Trip'
                        ],
                        "title"                   => "SEO, Tips and Tricks 2023 01",
                        "start_date_tour"         => Carbon::parse('2024-05-01'),
                        "end_date_tour"           => Carbon::parse('2024-05-10'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 12,
                        "days"                    => 8,
                        "nights"                  => 7,
                        "start_registration_date" => Carbon::parse('2024-03-25'),
                        "end_registration_date"   => Carbon::parse('2024-04-18'),
                        //'accommodation'        => 'Ecolodge and camping',
                        //"price"                  => 195,
                        "status"                  => GroupStatusEnum::soldOut,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 960,
                                "ending_location"   => 962,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 3,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'SEO Tips and Tricks in the autumn- Landa Trip'
                        ],
                        "title"                   => "SEO, Tips and Tricks 2023 01",
                        "start_date_tour"         => Carbon::parse('2023-09-01'),
                        "end_date_tour"           => Carbon::parse('2023-09-10'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 12,
                        "days"                    => 8,
                        "nights"                  => 7,
                        "start_registration_date" => Carbon::parse('2023-07-25'),
                        "end_registration_date"   => Carbon::parse('2023-08-18'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 195,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 932,
                                "ending_location"   => 936,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'astronomy-and-photography-of-the-nature.webp',
                    'image_type' => 'header',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'astronomy-and-photography-of-the-nature.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'astronomy-and-photography-of-the-nature.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'language_id'          => 2,
                'title'                => 'Astronomie et photographie de la nature',
                'short_summary'        => "Fixez le ciel nocturne, flottez sur le mystère de l'univers avec la photographie pour conserver des souvenirs.",
                'city_id'              => 1044,
                //'group_size'           => '8-14 people',
                ////'accommodation'        => 'Ecolodge and camping',
                //'meals'                => 'One Breakfast, One dinner, One lunch',
                //'transport'            => 'Private car',
                //'days'                 => 2,
                //'nights'               => 1,
                //'price'                     =>  2.95,
                'skills'               => 'Digital Marketing',
                'tour_overview'        => "<p>Cette visite s'adresse à toutes les personnes intéressées par la photographie et l'astronomie, qui croient pouvoir trouver leur fortune dans le ciel ou qui souhaitent s'évader de la monotonie de la vie ne serait-ce qu'une nuit.</p> <p> Contemplez l'orbite majestueuse des planètes autour de leurs étoiles respectives et tentez de capturer les merveilles à contempler dans l'univers à travers votre objectif.</p>",
                'highlights'           => [
                    [
                        'title' => 'Apprendre à prendre de bonnes photos de la nature e'
                    ],
                    [
                        'title' => 'Apprendre à équilibrer les couleurs et les contrastes lors des levers de soleil et des moments ensoleillés.'
                    ],
                    [
                        'title' => 'Prendre des photos avec le trépied dans la nature'
                    ],
                    [
                        'title' => 'Réglage de la luminosité et du contraste dans les environnements sombres'
                    ],
                    [
                        'title' => "Trouvez les meilleures dates de l'astrologie"
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'Jour 1:Commencer un bon petit voyage',
                        'description' => "<p>Notre voyage commence à l'extérieur de la ville d'Esfahan sur la route d'Abyaneh. Il faut environ deux heures pour y arriver, puis nous avons une courte classe pour une introduction à la photographie, aux outils et aux exigences. </p><p>Après cela, notre atelier de photographie se concentrera sur la capture de la nature, des animaux et des objets naturels. Nous aurons beaucoup de pratique avec des prises de vue panoramiques et des cadrages à longue distance. Nous aurons une courte pause déjeuner, puis nous continuerons à pratiquer la photographie avant le coucher du soleil. Nous prévoyons de prendre de superbes photos du soleil couchant et du ciel bleu-rouge.</p> <p>Après un court dîner tôt dans la nuit, nous serons à l'extérieur, dans les bois, jusqu'au lever du soleil. Le coach aidera les étudiants à installer les trépieds et les appareils photo afin de capturer des images merveilleuses du système zodiacal, des planètes et des autres étoiles.</p>"
                    ],
                    [
                        'title'       => 'jour 2: le milieu de la nuit est tout',
                        'description' => "<p>Cette journée a commencé avec les activités en extérieur de la nuit précédente. Nous avons fait une courte sieste le matin après le lever du soleil et pris un petit-déjeuner tardif avant midi. Tous les étudiants doivent se rassembler et présenter leurs photos sur le vidéoprojecteur, et le coach les commente jusqu'au déjeuner.</p> <p>Le fait de déguster un délicieux déjeuner change votre humeur et vous serez prêt à rentrer chez vous avec de nombreux souvenirs doux et de nouvelles connaissances.</p>"
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'Hébergement en écolodge',
                    ],
                    [
                        'title' => 'Un petit-déjeuner',
                    ],
                    [
                        'title' => 'Un déjeuner',
                    ],
                    [
                        'title' => 'Un dîner',
                    ],
                    [
                        'title' => 'Certificats',
                    ],
                    [
                        'title' => 'Assurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'Le transport'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "kavir-2022-04-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-07.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-08.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-09.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => 'Landa Trip Certification',
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => "Combien coûte l'assurance pour le voyage pour chaque personne?",
                        'answer'   => 'Environ 100 milliards de rials (3 000 dollars américains) pour les blessés et les handicaps corporels. Et 2 fois plus en cas de décès accidentel.'
                    ],
                    [
                        'question' => 'Quels documents sont indispensables pour ce voyage organisé?',
                        'answer'   => "Bien que votre passeport soit le seul document officiel pour votre voyage, il est nécessaire d'avoir 5 ans de direction exécutive pour l'entreprise."
                    ],
                    [
                        'question' => 'Comment annuler des cours de voyage?',
                        'answer'   => "Vous devez annuler votre voyage au moins 12 jours avant le départ.Dans cette condition, vous pouvez rembourser 70% de votre paiement.Après cette date, malheureusement, il n'est plus possible de retourner un paiement."
                    ],
                    [
                        'question' => 'Puis-je voyager avec mon mari/ma femme ?ou mes enfants?',
                        'answer'   => "Oui. Il est possible d'avoir des compagnons de route avec vous.Mais s'il vous plaît vérifier avec Landa trip pour l'hébergement, un billet d'avion, etc."
                    ],
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Leila',
                        'star'    => 5,
                        'comment' => 'Ce fut une expérience vraiment inoubliable pour moi.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Ali',
                        'star'    => 4,
                        'comment' => "J'ai vraiment apprécié ce voyage. Il m'a fourni de nombreuses informations précieuses.",
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'Merci beaucoup.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Ava',
                        'star'    => 5,
                        'comment' => "c'est genial pour moi ",
                        'replies' => []
                    ],
                    [
                        'name'    => 'Sara',
                        'star'    => 3,
                        'comment' => "C'était la première fois que je partais en voyage avec Landa Trip et je dois dire que cela a dépassé toutes mes attentes, sauf en ce qui concerne les repas.",
                        'replies' => []
                    ],
                    [
                        'name'    => 'Soheil',
                        'star'    => 4,
                        'comment' => "Je suis parti en voyage avec ma famille et nous sommes tous d'accord pour dire que c'était le point culminant de nos vacances",
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 3,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Nature Photography course - Landa Trip'
                        ],
                        "title"                   => "Nature Photography 2022 03",
                        "start_date_tour"         => Carbon::parse('2025-01-10'),
                        "end_date_tour"           => Carbon::parse('2025-02-10'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2024-10-25'),
                        "end_registration_date"   => Carbon::parse('2024-11-30'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 2.95,
                        "status"                  => GroupStatusEnum::canceled,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 654,
                                "ending_location"   => 654,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 3,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Nature Photography course - Landa Trip'
                        ],
                        "title"                   => "Nature Photography 2023 01",
                        "start_date_tour"         => Carbon::parse('2025-02-19'),
                        "end_date_tour"           => Carbon::parse('2025-02-20'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-15'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 2.95,
                        "status"                  => GroupStatusEnum::startSoon,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 421,
                                "ending_location"   => 423,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ]
                ],
            ],
            [
                'header_pic'           => [
                    'url'        => 'think-strategically-and-make-your-ideas-a-reality.webp',
                    'image_type' => 'header',
                    'alt'        => 'Think Strategically and Make Your Ideas a Reality - Management Business Analysis - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'think-strategically-and-make-your-ideas-a-reality.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Think Strategically and Make Your Ideas a Reality - Management Business Analysis - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'think-strategically-and-make-your-ideas-a-reality.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Think Strategically and Make Your Ideas a Reality - Management Business Analysis - Landa Trip'
                ],
                'language_id'          => 2,
                'title'                => 'Pensez stratégiquement et concrétisez vos idées',
                'short_summary'        => 'Comprendre les concepts fondamentaux de la prise de décision, de la réflexion stratégique et de la réussite des projets',
                'city_id'              => 793,
                //'group_size'           => '8 - 12',
                ////'accommodation'        => '4-Star Hotel',
                //'meals'                => '4 Breakfast, 2 lunch, and 1 dinner',
                //'transport'            => 'Airport transport for arrival and departure',
                //'days'                 => 5,
                //'nights'               => 4,
                //'price'                     =>  550,
                'skills'               => 'Management, Business Analysis',
                'tour_overview'        => "<p class=\'text-justify ml-3 mb-1\'>Récemment, le chaos économique tel que les guerres commerciales, l'épidémie de Covid-19, la crise pétrolière et le Brexit ont un impact considérable sur les entreprises du monde entier. Comment pensez-vous et prenez-vous des décisions dans ces conditions ?</p> <p class=\'text-justify ml-3 mb-1\'>Penser de manière stratégique est la meilleure approche pour votre vie personnelle et professionnelle. C'est une démarche procédurale qui devrait devenir une habitude dans votre esprit. Elle prend en compte toutes les forces, opportunités, menaces et faiblesses de manière globale.</p> <p class=\'text-justify ml-3 mb-1\'>Dans de telles situations, il est essentiel de vous accorder un temps spécifique pour vous-même, afin d'améliorer votre esprit et vos capacités, loin de toutes les distractions</p>",
                'highlights'           => [
                    [
                        'title' => 'Développer votre capacité de réflexion stratégique'
                    ],
                    [
                        'title' => 'Faites de la réflexion stratégique une habitude'
                    ],
                    [
                        'title' => "Comment être plus agile et adapté aux changements rapides d'aujourd'hui"
                    ],
                    [
                        'title' => 'Augmentez les chances de succès de vos projets et de votre vie professionnelle'
                    ],
                    [
                        'title' => 'Comment avoir des réponses rapides aux problèmes'
                    ],
                    [
                        'title' => 'Changer et faire évoluer votre cadre personnel et professionnel'
                    ],
                ],
                'itineraries'          => [
                    [
                        'title'       => 'Jour 1 : Arrivée et chaleureuse bienvenue',
                        'description' => "<p>Le début de votre voyage commence à l'aéroport international Imam Khomeini (IKA) avec un court vol (environ 2 heures et demie) vers l'aéroport d'Istanbul (IST). Nos fourgonnettes vous attendent à l'aéroport pour vous assurer un transfert tranquille et sécurisé vers l'hôtel.</p> <p>Après un court repos et avoir déposé vos bagages à l'hôtel, nous partons tous ensemble pour une visite touristique de l'avenue Esteghlal (İstiklâl Caddesi). Notre visite se poursuit le long de cette rue et de ses monuments, tels que le Çiçek Pasajı, le lycée de Galatasaray, et autres. Nous marchons en direction de Narmanlı Han pour le dîner.</p>"
                    ],
                    [
                        'title'       => 'Jour 2 : Début du voyage éducatif',
                        'description' => "<p>Le petit-déjeuner sera servi à l'hôtel, qui est également proche de la salle de classe. Veuillez vous rendre dans la salle de classe avant 9h30, heure locale (TRT).</p> <p>On the first day, we have a short introduction to each other. It caused to make a friendly and cooperative atmosphere between students and the lecturer.</p> <p>La classe se poursuivra jusqu'en fin de journée, jusqu'à 17h00, heure locale (TRT), avec deux pauses et un temps de déjeuner inclus dans le forfait de la visite.</p>"
                    ],
                    [
                        'title'       => 'Jour 3 : Exceller dans nos activités',
                        'description' => "<p>Ce jour marque un tournant dans votre parcours éducatif, alors veuillez mobiliser toutes vos capacités pour agir. La classe de ce jour se déroulera de 9h30 à 17h00, comme hier, mais comportera de nombreuses activités, discussions et exemples. Soyez prêt à participer activement et à poser des questions tout au long de la journée.</p> <p>Vous devriez développer une approche critique et stratégique dans votre esprit. Vous devriez le faire de manière répétée pour passer d'une façon de penser à une habitude.</p>"
                    ],
                    [
                        'title'       => "Jour 4 : Le temps et les opportunités s'épuisent",
                        'description' => "<p>Ce jour marque la dernière journée de votre classe. La classe se déroulera à temps partiel, de 9h30 du matin à 13h00, heure locale (TRT), et se terminera avant l'heure du déjeuner.</p> <p>Après cela, vous êtes libre de profiter de votre temps libre jusqu'au soir. Nous aurons un délicieux dîner pour la soirée d'adieu lors de notre dernière nuit de ce cours dans cette magnifique ville.</p>"
                    ],
                    [
                        'title'       => 'Jour 5 : Les dernières secondes',
                        'description' => "<p>Après le petit-déjeuner, tous les étudiants voyageurs sont prêts pour le départ à l'aéroport.</p> <p>Une photo de groupe, de nouveaux amis, de nouvelles connexions et des certifications seront les meilleurs souvenirs de ce voyage pour vous-même et votre entreprise.</p>"
                    ]
                ],
                'includes'             => [
                    [
                        'title' => "Billet d'avion (aller-retour)",
                    ],
                    [
                        'title' => 'Hébergement en hôtel 4 étoiles',
                    ],
                    [
                        'title' => 'Transport aéroport',
                    ],
                    [
                        'title' => '4 petits déjeuners',
                    ],
                    [
                        'title' => '2 déjeuners',
                    ],
                    [
                        'title' => '1 dîner',
                    ],
                    [
                        'title' => 'Cours et certifications',
                    ],
                    [
                        'title' => 'Assurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => "Taxes de départ de l'Iran"
                    ],
                    [
                        'title' => "Transport de l'aéroport Imam Khomeiny"
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "strategically-course-1.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-2.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-3.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-4.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-5.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-6.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-7.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-8.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-9.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "Pensez stratégiquement et concrétisez vos idées",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => "Combien coûte l'assurance pour le voyage pour chaque personne?",
                        'answer'   => 'Environ 100 milliards de rials (3 000 dollars américains) pour les blessés et les handicaps corporels. Et 2 fois plus en cas de décès accidentel.'
                    ],
                    [
                        'question' => 'Quels documents sont indispensables pour ce voyage organisé?',
                        'answer'   => "Bien que votre passeport soit le seul document officiel pour votre voyage, il est nécessaire d'avoir 5 ans de direction exécutive pour l'entreprise."
                    ],
                    [
                        'question' => 'Comment annuler des cours de voyage?',
                        'answer'   => "Vous devez annuler votre voyage au moins 12 jours avant le départ.Dans cette condition, vous pouvez rembourser 70% de votre paiement.Après cette date, malheureusement, il n'est plus possible de retourner un paiement."
                    ],
                    [
                        'question' => 'Puis-je voyager avec mon mari/ma femme ?ou mes enfants?',
                        'answer'   => "Oui. Il est possible d'avoir des compagnons de route avec vous.Mais s'il vous plaît vérifier avec Landa trip pour l'hébergement, un billet d'avion, etc."
                    ],
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Ali',
                        'star'    => 4,
                        'comment' => "C'était un temps de loisirs et d'éducation incroyable pour moi. Le comportement du tuteur était si respectueux. Le seul problème était le manque de temps libre à Istanbul.",
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'Merci pour votre commentaire.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Sam',
                        'star'    => 5,
                        'comment' => "Ce stage de voyage me fait changer d'avis. Je me sens amélioré dans ma façon de penser au monde",
                        'replies' => []
                    ],
                    [
                        'name'    => 'Sara',
                        'star'    => 3,
                        'comment' => "Le cours était fantastique, mais la distance entre l'hôtel et la salle de classe était longue pour moi.",
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'merci.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Parsa',
                        'star'    => 4,
                        'comment' => 'Juste magnifique mon pote.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Soheil',
                        'star'    => 5,
                        'comment' => 'Ce cours était un travail élégant mec.',
                        'replies' => []
                    ]

                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 2,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Think Strategically for SAAS - Landa Trip'
                        ],
                        "title"                   => "Think Strategically for SAAS companies 2022 02",
                        "start_date_tour"         => Carbon::parse('2025-02-01'),
                        "end_date_tour"           => Carbon::parse('2025-02-10'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 3,
                        "nights"                  => 2,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-25'),
                        //'accommodation'        => 'Ecolodge and camping',
                        //"price"                  => 550,
                        "status"                  => GroupStatusEnum::onGoing,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 1200,
                                "ending_location"   => 1201,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 2,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Think Strategically for SAAS - Landa Trip'
                        ],
                        "title"                   => "Think Strategically for SAAS companies 2022 07",
                        "start_date_tour"         => Carbon::parse('2025-07-01'),
                        "end_date_tour"           => Carbon::parse('2025-07-10'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 20,
                        "days"                    => 9,
                        "nights"                  => 8,
                        "start_registration_date" => Carbon::parse('2025-05-25'),
                        "end_registration_date"   => Carbon::parse('2025-06-25'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 610,
                        "status"                  => GroupStatusEnum::completed,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 532,
                                "ending_location"   => 536,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'tech-and-invest-in-oman-a-journey-of-innovation-and-opportunity.webp',
                    'image_type' => 'header',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'tech-and-invest-in-oman-a-journey-of-innovation-and-opportunity.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'tech-and-invest-in-oman-a-journey-of-innovation-and-opportunity.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'language_id'          => 2,
                'title'                => "Technologie et investissement à Oman : un parcours d'innovation et d'opportunités",
                'short_summary'        => "Découvrez l'avenir de l'investissement et de la technologie à Oman : un voyage à travers les pôles d'innovation et les zones économiques",
                'city_id'              => 13,
                //'group_size'           => '15-20 people',
                ////'accommodation'        => '4-star hotel',
                //'meals'                => '6 Breakfast, One dinner',
                //'transport'            => 'Airport and daily transfer followed the itinerary',
                //'days'                 => 7,
                //'nights'               => 6,
                //'price'                     =>  2.95,
                'skills'               => 'gestion des affaires',
                'tour_overview'        => "<p>Embarquez pour un voyage de 6 nuits et 7 jours à travers le paysage technologique et d'investissement d'Oman. Découvrez la riche culture et l'architecture du pays en visitant la grande mosquée du Sultan Qaboos et le palais Al Alam, puis plongez dans l'industrie technologique en pleine croissance d'Oman en rencontrant des représentants de l'Oman Investment Authority et du Oman Technology Fund.</p> <p>Découvrez le paysage commercial d'Oman en visitant le Centre national des affaires et explorez les avantages de la zone franche de Sohar. Assistez à des performances de classe mondiale au Royal Opera Oman et découvrez les efforts de conservation marine d'Oman à l'Aqua Center.</p> <p>Enfin, faites du shopping, des restaurants et des divertissements au centre commercial de Mascate avant de ramener chez vous des souvenirs inoubliables du mélange unique de tradition et de modernité d'Oman. </p>",
                'highlights'           => [
                    [
                        'title' => 'Visitez les plus grandes mosquées du monde'
                    ],
                    [
                        'title' => "Présentant de nombreuses opportunités d'investissement"
                    ],
                    [
                        'title' => "Visitez les centres d'affaires d'Oman"
                    ],
                    [
                        'title' => 'Oman Investment Authority et Oman Technology Fund'
                    ],
                    [
                        'title' => "Shopping dans les meilleurs marchés d'Oman"
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => "Shopping dans les meilleurs marchés d'Oman",
                        'description' => "<p>Le voyage commence par un vol matinal de Téhéran à Mascate, la capitale d'Oman.</p> <p>À votre arrivée, vous serez escorté à votre hôtel pour l'enregistrement et un court repos, il commencera par explorer la grandeur de la Grande Mosquée du Sultan Qaboos, qui est l'une des plus grandes mosquées du monde. les détails complexes de l'architecture sont admirables et ont appris l'histoire et la culture de la foi islamique d'Oman.</p> <p>Dans la soirée, la beauté du palais Al Alam, le palais de cérémonie du sultan d'Oman vous attend, situé au cœur de Mascate, le palais présente une superbe façade dorée et bleue et offre une vue spectaculaire sur le port.</p>"
                    ],
                    [
                        'title'       => "Jour 2: Découvrez les joyaux d'investissement d'Oman",
                        'description' => "<p>Après le petit-déjeuner à l'hôtel, visitez l'Oman Investment Authority, une agence gouvernementale qui facilite les investissements à Oman. Rencontrez des représentants pour en savoir plus sur les opportunités d'investissement dans le pays et explorez les possibilités pour votre entreprise. Après cela, visitez le Oman Technology Fund, un fonds de capital-risque qui investit dans des startups technologiques à Oman et dans la région.</p> <p>Vous rencontrerez des entrepreneurs locaux et découvrirez les technologies de pointe développées à Oman.</p>"
                    ],
                    [
                        'title'       => 'Jour 3 : Autonomiser les entrepreneurs',
                        'description' => "<p>Aujourd'hui, vous visiterez le National Business Centre, un centre qui offre un soutien et des ressources aux entrepreneurs et aux petites entreprises.</p><p>Vous aurez l'occasion d'assister à des ateliers et à des événements de réseautage et d'en apprendre davantage sur le paysage des affaires à Oman. Vous pourrez également rencontrer des entrepreneurs locaux et entendre leurs histoires de réussite.</p>"
                    ],
                    [
                        'title'       => "Jour 4 : Zone franche de Sohar : là où l'investissement rencontre l'opportunité",
                        'description' => "<p>Aujourd'hui, vous vous rendrez à Sohar, situé sur la côte nord d'Oman, pour explorer la zone franche de Sohar, une zone économique désignée qui offre des incitations fiscales et d'autres avantages aux entreprises.</p><p>Vous rencontrerez des représentants de diverses industries et découvrirez les opportunités d'investissement dans la région. Vous aurez également la chance de visiter le port industriel de Sohar et de voir les différentes industries en action.</p>"
                    ],
                    [
                        'title'       => 'Jour 5 : Art et Merveilles Océaniques',
                        'description' => "<p>Le premier arrêt d'aujourd'hui est le Royal Opera Oman, un grand centre des arts de la scène qui accueille divers spectacles et performances. Laissez-vous séduire par l'architecture époustouflante et les performances de classe mondiale.</p><p>Après cela, continuez vers l'Aqua Center, un centre d'enseignement et de recherche qui présente la vie marine unique d'Oman.</p><p>Vous découvrirez les efforts d'Oman en matière de conservation marine et aurez la chance d'interagir avec des animaux marins.</p>"
                    ],
                    [
                        'title'       => 'Jour 6: Offrez-vous le luxe au centre commercial de Mascate',
                        'description' => "<p>Aujourd'hui, vous aurez une journée libre pour explorer la ville à votre rythme. Visitez le Mall of Muscat, l'un des plus grands centres commerciaux d'Oman, et faites du shopping, des restaurants et des divertissements. Le centre commercial propose des marques de luxe haut de gamme, une variété d'options de restauration et un cinéma ultramoderne.</p>"
                    ],
                    [
                        'title'       => 'Jour 7 : Souvenirs impérissables et départ',
                        'description' => "<p>Passez vos dernières heures au centre commercial de Mascate avant de vous rendre à l'aéroport international de Mascate pour votre vol de retour vers Téhéran. Emportez avec vous des souvenirs inoubliables de l'investissement et des merveilles technologiques d'Oman.</p>"
                    ]
                ],
                'includes'             => [
                    [
                        'title' => "L'aéroport et le transfert quotidien ont suivi l'itinéraire",
                    ],
                    [
                        'title' => 'Hébergement en hôtel 4 étoiles',
                    ],
                    [
                        'title' => '6 petit-déjeuner, 1 dîner',
                    ],
                    [
                        'title' => 'Assurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'Traducteur local'
                    ],
                    [
                        'title' => 'Juriste et conseiller juridique'
                    ],
                    [
                        'title' => 'Conseiller financier et commercial'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "kavir-2022-04-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-07.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-08.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-09.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         =>
                //                    [
                //                        [
                //                            'title'            => 'LandaTrip Presentation Certification',
                //                            'certificate_type' => "Certification of participation"
                //                        ]
                //                    ],
                'terms_and_conditions' => [
                    [
                        'question' => "Combien coûte l'assurance pour le voyage pour chaque personne?",
                        'answer'   => 'Environ 100 milliards de rials (3 000 dollars américains) pour les blessés et les handicaps corporels. Et 2 fois plus en cas de décès accidentel.'
                    ],
                    [
                        'question' => 'Quels documents sont indispensables pour ce voyage organisé?',
                        'answer'   => "Bien que votre passeport soit le seul document officiel pour votre voyage, il est nécessaire d'avoir 5 ans de direction exécutive pour l'entreprise."
                    ],
                    [
                        'question' => 'Comment annuler des cours de voyage?',
                        'answer'   => "Vous devez annuler votre voyage au moins 12 jours avant le départ.Dans cette condition, vous pouvez rembourser 70% de votre paiement.Après cette date, malheureusement, il n'est plus possible de retourner un paiement."
                    ],
                    [
                        'question' => 'Puis-je voyager avec mon mari/ma femme ?ou mes enfants?',
                        'answer'   => "Oui. Il est possible d'avoir des compagnons de route avec vous.Mais s'il vous plaît vérifier avec Landa trip pour l'hébergement, un billet d'avion, etc."
                    ],
                ],
                //'dates'                => '',
                'comments'             => [],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 2,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Tech and Invest in Oman'
                        ],
                        "title"                   => "Tech and Invest in Oman",
                        "start_date_tour"         => Carbon::parse('2025-06-13'),
                        "end_date_tour"           => Carbon::parse('2025-06-19'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 12,
                        "nights"                  => 11,
                        "start_registration_date" => Carbon::parse('2024-05-25'),
                        "end_registration_date"   => Carbon::parse('2024-06-02'),
                        //'accommodation'        => '3-Star Hotel',
                        //"price"                  => 650,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 458,
                                "ending_location"   => 459,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 2,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Tech and Invest in Oman'
                        ],
                        "title"                   => "Tech and Invest in Oman in the winter",
                        "start_date_tour"         => Carbon::parse('2024-10-13'),
                        "end_date_tour"           => Carbon::parse('2024-10-19'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 14,
                        "nights"                  => 13,
                        "start_registration_date" => Carbon::parse('2024-08-25'),
                        "end_registration_date"   => Carbon::parse('2024-09-02'),
                        //'accommodation'        => 'Ecolodge and camping',
                        //"price"                  => 710,
                        "status"                  => GroupStatusEnum::preRegistration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 965,
                                "ending_location"   => 966,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ]
                ]
            ],


            // Persian
            [
                'header_pic'           => [
                    'url'        => 'seo-tips-and-tricks.webp',
                    'image_type' => 'header',
                    'alt'        => 'SEO, Tips and Tricks - Information Technology, Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'seo-tips-and-tricks.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'SEO, Tips and Tricks - Information Technology, Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'seo-tips-and-tricks.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'SEO, Tips and Tricks - Information Technology, Digital Marketing - Landa Trip'
                ],
                'language_id'          => 3,
                'title'                => 'نکات و ترفندهای سئو',
                'short_summary'        => 'نکات کوچک و مفید در مورد بهینه سازی موتور جستجو و ترفندهای عملی برای بهبود وب سایتان',
                'city_id'              => 11,
                //'group_size'           => '۸ تا 14 نفر',
                ////'accommodation'        => 'هتل چهار ستاره',
                //'meals'                => 'چهار صبحانه، دو ناهار و یک شام',
                //'transport'            => 'حمل و نقل فرودگاهی تا هتل',
                //'days'                 => 5,
                //'nights'               => 4,
                //'price'                     =>  195,
                'skills'               => 'Information Technology, Digital Marketing',
                'tour_overview'        => '<p>امروزه اینترنت مهمترین ابزار برای ارائه و فروش محصولات است و وب سایت ها پیش نمایش این روند هستند. اگر دوست دارید یک وب سایت محبوب برای تبلیغ خدمات و محصولات خود داشته باشید، نکات زیر ضروری است:</p>',
                'highlights'           => [
                    [
                        'title' => 'آشنایی با الگوریتم های گوگل'
                    ],
                    [
                        'title' => 'تجزیه و تحلیل رقابتی در یک صفحه وب'
                    ],
                    [
                        'title' => 'درک درستی از نحوه عملکرد سئو موتورهای جستجو'
                    ],
                    [
                        'title' => 'ایندکس کردن وب سایت برای موتورهای جستجو'
                    ],
                    [
                        'title' => 'یافتن کلمات کلیدی'
                    ],
                    [
                        'title' => 'تجزیه و تحلیل سرعت بارگذاری صفحه'
                    ],
                    [
                        'title' => 'نحوه ایجاد بک لینک از منابع تایید شده و قابل اعتماد'
                    ],
                    [
                        'title' => 'اجتناب از کارهایی با اثر منفی بر سئو'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'روز اول: به جزیره کیش خوش آمدید',
                        'description' => '<p>بعد از یک سفر هوایی کوتاه صبح به جزیره کیش می رسیم  و به هتل می رویم. عصر یک ملاقات دوستانه در یکی از کافی شاپ های زیبا در نزدیکی ساحل میراث داریم، همه دانش آموزان و استاد راهنما برای یک سفر دوستانه و آموزش به یکدیگر معرفی می شوند.</p>'
                    ],
                    [
                        'title'       => 'روز دوم: دوره در حال انجام است، آیا آماده هستید؟',
                        'description' => '<p>پس از صرف صبحانه در هتل، تنها یک پیاده روی کوتاه برای رسیدن به کلاس لازم است. شروع کلاس ساعت 9 صبح است و تا ساعت 17 که پایان کلاس است، دو استراحت کوتاه و یک وقت ناهار دارید.</p> <p>در این کلاس یاد می گیرید که سئو چیست، چرا باید از آن استفاده کنید و الگوریتم های گوگل چگونه کار می کنند </p> <p>منطقی است که محتوای نظری در روز اول بیش از عملی باشد، اما باید آنها را جذب کنید.</p>'
                    ],
                    [
                        'title'       => 'روز سوم: تحلیل عملی شروع می شود',
                        'description' => '<p>مثل دیروز ساعت کلاس همینطور است اما محتوا از نظری و پاورپوینت به تحلیل عملی کسب و کارها تبدیل می شود. کسب و کار شما دارای رقیب و تجزیه و تحلیل کلمات کلیدی با همکاری دیگران است. این یکی از مزایای منحصر به فرد در دوره های مشابه فوق است.  </p> <p>شما باید به نظرات توجه داشته باشید و بعد از دوره انجام دهید.  </p>'
                    ],
                    [
                        'title'       => 'روز چهارم: دانش خود را به کار بگیرید',
                        'description' => '<p>این روز آخرین روز کلاس شماست. کلاس به صورت پاره وقت (از ساعت 9:30 صبح الی 13:00) بوده و قبل از صرف ناهار به پایان می رسد.
                        </p> <p>وقت آن رسیده است که دانش جدید خود را در وب سایت کسب و کار خود به صورت عملی اعمال کنید. </p>'
                    ],
                    [
                        'title'       => 'روز پنجم: آخرین ثانیه ها',
                        'description' => '<p>پس از صرف صبحانه، تمامی مسافران دانشجو در فرودگاه آماده حرکت هستند.
                        </p> <p>یک عکس دسته جمعی، دوستان جدید، ارتباطات جدید و گواهینامه ها بهترین سوغاتی از این سفر برای شما و کسب و کارتان خواهد بود.
                        </p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'بلیط هواپیما (دو طرفه)',
                    ],
                    [
                        'title' => 'اقامت در هتل 4 ستاره',
                    ],
                    [
                        'title' => 'حمل و نقل فرودگاهی',
                    ],
                    [
                        'title' => 'چهار وعده صبحانه',
                    ],
                    [
                        'title' => 'دو وعده ناهار',
                    ],
                    [
                        'title' => 'یک وعده شام',
                    ],
                    [
                        'title' => 'دوره و گواهینامه ها',
                    ],
                    [
                        'title' => 'بیمه',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => '•	The airport transportation'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "seo-course-1.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-2.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-3.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-4.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-5.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-6.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-7.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-8.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-9.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-13.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-14.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-15.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-16.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-17.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "seo-course-18.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "نکات و ترفندهای سئو",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => 'بیمه سفر برای هر نفر چقدر است؟',
                        'answer'   => 'حدود 100 میلیارد ریال (3000 دلار آمریکا) برای مصدومان و معلولیت های بدنی و 2 برابر بیشتر از آن برای مرگ تصادفی.
                        '
                    ],
                    [
                        'question' => 'چه مدارکی برای این پکیج تور ضروری است؟',
                        'answer'   => 'اگرچه گذرنامه تنها مدرک رسمی برای سفر شماست، اما داشتن مدیریت اجرایی 5 ساله برای مشارکت ضروری است.'
                    ],
                    [
                        'question' => 'چگونه می توانم دوره خود را لغو کنم؟',
                        'answer'   => 'حداقل 12 روز قبل از حرکت باید سفر خود را لغو کنید. در این شرایط می توانید 70 درصد مبلغ پرداختی خود را پس بگیرید. پس از این تاریخ، متأسفانه امکان برگشت هیچ گونه پرداختی وجود ندارد.
                        '
                    ],
                    [
                        'question' => 'آیا می توانم با شوهر یا همسرم سفر کنم؟ یا بچه هایم؟',
                        'answer'   => 'بله، این امکان وجود دارد که همسفرهایی با شما باشند،اما لطفا برای اقامت، بلیط هواپیما و ... با لاندا تریپ در ارتباط باشید .
                        '
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'مریم صادقی',
                        'star'    => 5,
                        'comment' => ' من می توانم روند رتبه بندی در نتایج گوگل را در این دوره درک کنم. من از فردا شروع به اعمال تمام نکات در تجارت آنلاین خود خواهم کرد.
                        ',
                        'replies' => []
                    ],
                    [
                        'name'    => 'محمد صالحی',
                        'star'    => 4,
                        'comment' => ' اکنون می توانم خدمات سئو را به خدمات ساخت وب سایت خود اضافه کنم. من دوست دارم دوره طولانی تری داشته باشم
                        ',
                        'replies' => []
                    ],
                    [
                        'name'    => 'مهدی رحیمی',
                        'star'    => 5,
                        'comment' => 'بسیار عالی! به همه صاحبان مشاغل آنلاین توصیه می کنم',
                        'replies' => []
                    ],
                    [
                        'name'    => 'لیلا جعفری',
                        'star'    => 3,
                        'comment' => 'تجربه بسیار زیبا، با دوستان جدید. اما دوست دارم فعالیت کلاسی طولانی تر و کاربردی تری داشته باشم. سوالات زیاد وقت کلاس را تلف می کند. دوست دارم زمان بیشتری در کلاس باشم
                        ',
                        'replies' => []
                    ],
                    [
                        'name'    => 'رضا باقری',
                        'star'    => 3,
                        'comment' => 'من عمیقا به این دوره علاقه مند شده ام ',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'نکات و ترفند‌های سئو - لانداتریپ'
                        ],
                        "title"                   => "نکات و ترفند‌های سئو 1402 فصل بهار",
                        "start_date_tour"         => Carbon::parse('2025-03-01'),
                        "end_date_tour"           => Carbon::parse('2025-03-10'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 16,
                        "nights"                  => 15,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-15'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 195,
                        "status"                  => GroupStatusEnum::startSoon,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 653,
                                "ending_location"   => 654,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'SEO Tips and Tricks - Landa Trip'
                        ],
                        "title"                   => "نکات و ترفند‌های سئو 1402 فصل بهار",
                        "start_date_tour"         => Carbon::parse('2025-05-01'),
                        "end_date_tour"           => Carbon::parse('2025-05-10'),
                        "min_capacity"            => 14,
                        "max_capacity"            => 20,
                        "days"                    => 8,
                        "nights"                  => 7,
                        "start_registration_date" => Carbon::parse('2025-03-25'),
                        "end_registration_date"   => Carbon::parse('2025-04-18'),
                        //'accommodation'        => '5-Star Hotel',
                        //"price"                  => 195,
                        "status"                  => GroupStatusEnum::canceled,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 320,
                                "ending_location"   => 321,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'SEO Tips and Tricks - Landa Trip'
                        ],
                        "title"                   => "نکات و ترفند‌های سئو 1402 فصل پاییز",
                        "start_date_tour"         => Carbon::parse('2025-08-01'),
                        "end_date_tour"           => Carbon::parse('2025-08-10'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 9,
                        "nights"                  => 8,
                        "start_registration_date" => Carbon::parse('2025-06-25'),
                        "end_registration_date"   => Carbon::parse('2025-07-18'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 195,
                        "status"                  => GroupStatusEnum::soldOut,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 2200,
                                "ending_location"   => 2202,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'tech-and-invest-in-oman-a-journey-of-innovation-and-opportunity.webp',
                    'image_type' => 'header',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'tech-and-invest-in-oman-a-journey-of-innovation-and-opportunity.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'tech-and-invest-in-oman-a-journey-of-innovation-and-opportunity.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'language_id'          => 3,
                'title'                => 'تکنولوژی و سرمایه گذاری در عمان: سفری مملو از ایده ها و فرصت های نو',
                'short_summary'        => 'کشف آینده سرمایه گذاری و تکنولوژی  در عمان :سفری در مناطق اقتصادی و مراکز نوآوری',
                'city_id'              => 13,
                //'group_size'           => '15-20 people',
                ////'accommodation'        => '4-star hotel',
                //'meals'                => '6 Breakfast, One dinner',
                //'transport'            => 'Airport and daily transfer followed the itinerary',
                //'days'                 => 7,
                //'nights'               => 6,
                //'price'                     =>  2.95,
                'skills'               => 'Business Management',
                'tour_overview'        => '<p>سفری 6 شب و 7 روز، با چشم انداز سرمایه گذاری و فناوری عمان آغاز می کنیم. با بازدید از مسجد جامع سلطان قابوس و کاخ العالم، فرهنگ و معماری غنی کشور را کشف می کنیم . صنعت فناوری عمان در حال رشد است و ما در این سفر با نمایندگانی از سازمان سرمایه گذاری عمان و صندوق فناوری عمان، ملاقات می کنیم.</p><p>با بازدید از مرکز ملی کسب و کار، با چشم انداز کسب و کار در عمان آشنا می شویم و مزایای منطقه آزاد صحار را کشف می کنیم. اجراهایی در سطح جهانی را در رویال اپرای عمان تجربه می کنیم و اطلاعاتی در مورد تلاش‌های حفاظت از دریای عمان در مرکز آبی را کسب می کنیم.</p><p>در نهایت، قبل از اینکه خاطرات فراموش نشدنی عمان، که ترکیبی از سنت و مدرنیته است را به خانه ببریم، در مرکز خرید مسقط به خرید، خوردن غذا و سرگرمی می پردازیم.</p>',
                'highlights'           => [
                    [
                        'title' => 'از بزرگترین مساجد جهان که در عمان است دیدن می کنیم'
                    ],
                    [
                        'title' => 'فرصت های سرمایه گذاری متعدد در عمان را بررسی می کنیم'
                    ],
                    [
                        'title' => 'از مناطق اقتصادی عمان دیدن می کنیم'
                    ],
                    [
                        'title' => 'از سازمان سرمایه گذاری عمان و صندوق فناوری عمان دیدن می کنیم'
                    ],
                    [
                        'title' => 'از بهترین بازارهای عمان دیدن و خرید می کنیم'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'روز اول: مساجد و کاخ های سلطنتی الهام بخش',
                        'description' => '<p>سفر با پرواز صبحگاهی از تهران به مسقط، پایتخت عمان آغاز می شود.</p><p>به محض ورود، برای چک-این و استراحت کوتاه به هتل شما را همراهی می کنند، سپس با کاوش در عظمت مسجد جامع سلطان قابوس، که یکی از بزرگترین مساجد جهان است، سفر آغاز می شود. جزئیات پیچیده معماری تحسین برانگیز است و با تاریخ و فرهنگ دین اسلامی عمان آمیخته شده است.</p><p>در شب، زیبایی کاخ العالم، کاخ تشریفاتی سلطان عمان که در قلب مسقط قرار دارد، منتظر شماست، این کاخ دارای نمای خیره کننده طلایی و آبی است و منظره ای دیدنی از بندر را به نمایش می گذارد.</p>'
                    ],
                    [
                        'title'       => 'روز دوم: فرصت های سرمایه گذاری عمان را کشف کنید',
                        'description' => '<p>پس از صرف صبحانه در هتل، از سازمان سرمایه گذاری عمان، یک سازمان دولتی که سرمایه گذاری در عمان را تسهیل می کند، بازدید می کنیم. با نمایندگانی ملاقات می کنیم تا در مورد فرصت های سرمایه گذاری در کشور اطلاعات کسب کنیم و امکانات کسب و کار خود را بررسی کنیم. پس از آن، از صندوق فناوری عمان، یک صندوق سرمایه گذاری ریسک پذیر که بر روی استارت آپ های فناوری در عمان و منطقه سرمایه گذاری می کند، بازدید می کنیم.</p><p>شما می توانید با کارآفرینان محلی ملاقات کنید و در مورد فناوری های پیشرفته در حال توسعه در عمان اطلاعات کسب کنید.</p>'
                    ],
                    [
                        'title'       => 'روز سوم: توانمندسازی کارآفرینان',
                        'description' => '<p>امروز، از مرکز ملی کسب و کار بازدید خواهیم کرد، مرکزی که پشتیبانی و منابعی را برای کارآفرینان و کسب و کارهای کوچک ارائه می دهد.</p><p>شما این فرصت را خواهید داشت که در کارگاه ها و رویدادهای شبکه شرکت کنید و در مورد چشم انداز کسب و کار در عمان اطلاعات کسب کنید. شما همچنین می توانید با کارآفرینان محلی ملاقات کنید و داستان های موفقیت آنها را بشنوید.</p>'
                    ],
                    [
                        'title'       => 'روز چهارم: منطقه آزاد صحار: جایی که فرصت های سرمایه گذاری بسیار است',
                        'description' => '<p>امروز، ما به صحار، واقع در سواحل شمالی عمان، می‌رویم تا منطقه آزاد صحار را کاوش کنیم، یک منطقه اقتصادی تعیین‌شده که پیشنهاد های مالیاتی و سایر مزایا را برای مشاغل ارائه می‌دهد.</p><p>شما می توانید با نمایندگان صنایع مختلف ملاقات کنید و در مورد فرصت های سرمایه گذاری در این منطقه اطلاعات کسب کنید. شما همچنین این شانس را خواهید داشت که از بندر صنعتی صحار دیدن کنید و صنایع مختلف را در حال فعالیت ببینید.</p>'
                    ],
                    [
                        'title'       => 'روز پنجم: هنر و شگفتی های اقیانوسی',
                        'description' => '<p>اولین ایستگاه امروز رویال اپرای عمان است، یک مرکز هنرهای نمایشی بزرگ که میزبان نمایش ها و اجراهای مختلف است. شیفته معماری خیره کننده و اجراهایی در سطح جهانی می شوید.</p><p>پس از آن، به مرکز آکوا، یک مرکز آموزشی و تحقیقاتی که حیات دریایی منحصر به فرد عمان را به نمایش میگذارد، می رویم.</p><p>شما با تلاش های عمان در حفاظت از دریا آشنا خواهید شد و شانس تماشای حیوانات دریایی را خواهید داشت.</p>'
                    ],
                    [
                        'title'       => 'روز ششم:گشت و گذار در مرکز خرید لاکچری مسقط',
                        'description' => '<p>امروز، یک روز تفریحی خواهید داشت تا به بر حسب سلیقه ی خودتان از مرکز خرید مسقط، یکی از بزرگترین مراکز خرید عمان دیدن کنید و به خرید، خوردن غذا و سرگرمی بپردازید. این مرکز خرید دارای برندهای لوکس سطح بالا، انواع گزینه های رستوران و سینمای پیشرفته است.</p>'
                    ],
                    [
                        'title'       => 'روز هفتم: خاطرات ماندگار و برگشت',
                        'description' => '<p>ساعات پایانی خود را قبل از انتقال به فرودگاه بین المللی مسقط برای پرواز برگشت به تهران در مرکز خرید مسقط بگذرانید. خاطرات فراموش نشدنی سرمایه گذاری و شگفتی های فناوری عمان را با خود همراه کنید.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'ترانسفر فرودگاهی و ترانسفر برنامه های سفر',
                    ],
                    [
                        'title' => 'اقامت در هتل 4 ستاره',
                    ],
                    [
                        'title' => '6 صبحانه، 1 شام',
                    ],
                    [
                        'title' => 'بیمه',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'مترجم محلی'
                    ],
                    [
                        'title' => 'مشاور حقوقی و قانونی'
                    ],
                    [
                        'title' => 'مشاور مالی و بازرگانی'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "kavir-2022-04-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-07.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-08.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-09.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "تکنولوژی و سرمایه گذاری در عمان",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => 'بیمه سفر برای هر نفر چقدر است؟',
                        'answer'   => 'حدود 100 میلیارد ریال (3000 دلار آمریکا) برای مصدومان و معلولیت های بدنی. و 2 برابر بیشتر از آن برای مرگ تصادفی.'
                    ],
                    [
                        'question' => 'چه مدارکی برای این پکیج تور ضروری است؟',
                        'answer'   => 'گذرنامه تنها مدرک رسمی برای سفر شماست.'
                    ],
                    [
                        'question' => 'چگونه می توانم دوره سفر خود را لغو کنم؟',
                        'answer'   => 'حداقل 12 روز قبل از حرکت باید سفر خود را لغو کنید. در این شرایط می توانید 70 درصد مبلغ پرداختی خود را پس بگیرید. پس از این تاریخ، متاسفانه امکان برگشت هیچ گونه مبلغی وجود ندارد.'
                    ],
                    [
                        'question' => 'آیا می توانم با همسرم سفر کنم؟ یا فرزندان خود؟',
                        'answer'   => 'بله. این امکان وجود دارد که همسفرهایی با شما باشند اما لطفا برای اقامت، بلیط هواپیما و ... با لاندا تریپ در ارتباط باشید.'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Tech and Invest in Oman'
                        ],
                        "title"                   => "فناوری و نوآوری در عمان",
                        "start_date_tour"         => Carbon::parse('2025-06-13'),
                        "end_date_tour"           => Carbon::parse('2025-06-19'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-05-25'),
                        "end_registration_date"   => Carbon::parse('2025-06-02'),
                        //'accommodation'        => 'Ecolodge and camping',
                        //"price"                  => 650,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 2003,
                                "ending_location"   => 2004,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Tech and Invest in Oman in the winter'
                        ],
                        "title"                   => "فناوری و نوآوری در عمان",
                        "start_date_tour"         => Carbon::parse('2025-10-13'),
                        "end_date_tour"           => Carbon::parse('2025-10-19'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-09-25'),
                        "end_registration_date"   => Carbon::parse('2025-10-02'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 710,
                        "status"                  => GroupStatusEnum::preRegistration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 1966,
                                "ending_location"   => 1966,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'ielts-preparation-course.webp',
                    'image_type' => 'header',
                    'alt'        => 'IELTS, preparation course - Language - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'ielts-preparation-course.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'IELTS, preparation course - Language - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'ielts-preparation-course.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'IELTS, preparation course - Language - Landa Trip'
                ],
                'language_id'          => 3,
                'title'                => 'دوره آیلتس',
                'short_summary'        => 'آیلتس یک آزمون استاندارد برای تشخیص مهارت زبان انگلیسی است. دارای مهارت ها و سوالات متنوعی است که نیاز به تمرین دارد و برای پاسخ دادن به آنها در زمان کوتاه نیاز به تدبیر است. در این دوره یادگیری این موضوع توسط بهترین اساتید انجام میشود.
                ',
                'city_id'              => 2759,
                //'group_size'           => '10-12 people',
                ////'accommodation'        => '3-Star Hotel',
                //'meals'                => '14 Breakfast',
                //'transport'            => 'Airport transport for arrival and departure',
                //'days'                 => 15,
                //'nights'               => 14,
                //'price'                     =>  650,
                'skills'               => 'Language',
                'tour_overview'        => '<p>این دوره-سفر برای همه دانشجویانی است که قصد دارند تحصیلات خود را در یک کشور خارجی گسترش دهند. اگر دوست دارید در امتحاناتی مانند آیلتس و TEOEFL نمرات خوبی کسب کنید، اینجا بهترین فرصت برای شماست.</p>',
                'highlights'           => [
                    [
                        'title' => 'تعالی تدریس'
                    ],
                    [
                        'title' => 'مورد نیاز برای کار یا تحصیل'
                    ],
                    [
                        'title' => 'پیوستن به جامعه'
                    ],
                    [
                        'title' => 'یادگیری تسریع شده'
                    ],
                    [
                        'title' => 'معلمان بومی'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'روز اول: به استانبول خوش آمدید',
                        'description' => '<p>صبح بعد از یک سفر هوایی کوتاه به این شهر زیبا، ون ها منتظر ما هستند تا به هتل برویم و یک استراحت کوتاه داشته باشیم.</p> <p>عصر برای خرید اجناس و آشنایی با محیط و سایر دانش آموزان به یک مرکز خرید می رویم. </p>'
                    ],
                    [
                        'title'       => 'روز دوم: انگلیسی خود را تست کنید. نقطه شروع',
                        'description' => '<p>پس از صرف صبحانه در هتل، تنها یک پیاده روی کوتاه برای رسیدن به موسسه لازم است. دراین روز یک امتحان کوتاه برای تعیین سطح زبان انگلیسی خود دارید و سپس با توجه به نتایج به کلاس های مختلف منتقل می شوید.</p> <p>شما باید جدول زمانی خود را با توجه به این کلاس ها تنظیم کنید.</p>'
                    ],
                    [
                        'title'       => 'روز چهارم تا سیزدهم: دوره شروع شد، تلاش خود را بکنید',
                        'description' => '<p>شما باید در تمام کلاس های خود با توجه به جدول زمانی شرکت کنید. بنابراین، ساعت خود را به وقت محلی عوض کنید و تا 15 دقیقه قبل از شروع کلاس در جای خود آماده شوید. </p> <p>تقریباً کلاس ها از صبح تا عصر است، بنابراین شما وقت دارید که شب ها بیرون بروید و غذا بخورید. </p>'
                    ],
                    [
                        'title'       => 'روز چهاردهم: در آزمون شرکت کنید، آیا آماده هستید؟
                        ',
                        'description' => '<p>آیا برای آزمون نهایی آماده هستید؟ یادداشت های شب گذشته خود را مرور کنید و امتحان خود را با اطمینان انجام دهید.</p> <p>تبریک می گویم، شما در سطح بالایی هستید. شما می توانید پیشرفت خود را از نقطه شروع تا اینجا ببینید. این با ارزش ترین هدفی است که می توانید به آن برسید.</p>'
                    ],
                    [
                        'title'       => 'روز پانزدهم: آخرین لحظات دوره',
                        'description' => '<p>این روز آخرین لحظه سفر شماست. برو بیرون و با همه همکلاسی هایت عکس بگیر. اینها می توانند بهترین دوستان آینده شما باشند.</p> <p>بهبود زبان انگلیسی و نتیجه نهایی آزمون بهترین سوغاتی از این سفر برای شما و آینده شما خواهد بود.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'بلیط هواپیما (دو طرفه)',
                    ],
                    [
                        'title' => 'اقامت در هتل 3 ستاره',
                    ],
                    [
                        'title' => 'حمل و نقل فرودگاهی',
                    ],
                    [
                        'title' => '14 وعده صبحانه
                        ',
                    ],
                    [
                        'title' => 'دوره و گواهینامه ها',
                    ],
                    [
                        'title' => 'بیمه',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'حمل و نقل فرودگاهی در ایران'
                    ],
                    [
                        'title' => 'مواد آموزشی'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "ielts-course-1.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-2.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-3.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-4.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-5.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "ielts-course-6.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         =>
                //                    [
                //                        [
                //                            'title'            => "دوره آیلتس",
                //                            'certificate_type' => "Certification of participation"
                //                        ]
                //                    ],
                'terms_and_conditions' => [
                    [
                        'question' => 'بیمه سفر برای هر نفر چقدر است؟',
                        'answer'   => 'حدود 100 میلیارد ریال (3000 دلار آمریکا) برای مصدومان و معلولیت های بدنی. و 2 برابر بیشتر از آن برای مرگ تصادفی.'
                    ],
                    [
                        'question' => 'چه مدارکی برای این پکیج تور ضروری است؟',
                        'answer'   => 'اگرچه گذرنامه تنها مدرک رسمی برای سفر شماست، اما داشتن مدیریت اجرایی 5 ساله برای مشارکت ضروری است.'
                    ],
                    [
                        'question' => 'چگونه می توانم دوره سفر خود را لغو کنم؟',
                        'answer'   => 'حداقل 12 روز قبل از حرکت باید سفر خود را لغو کنید. در این شرایط می توانید 70 درصد مبلغ پرداختی خود را پس بگیرید. پس از این تاریخ، متأسفانه امکان برگشت هیچ گونه پرداختی وجود ندارد'
                    ],
                    [
                        'question' => 'آیا می توانم با شوهر یا همسرم سفر کنم؟ یا بچه هایم؟',
                        'answer'   => 'بله. این امکان وجود دارد که همسفرهایی با شما باشند. اما لطفا برای اقامت، بلیط هواپیما و ... با لاندا تریپ در ارتباط باشید'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'رهام علیزاده',
                        'star'    => 5,
                        'comment' => 'دوره به خوبی انجام شد. زیبا بود =)',
                        'replies' => []
                    ],
                    [
                        'name'    => 'آوا یوسفی',
                        'star'    => 4,
                        'comment' => 'پر زرق و برق خیلی جسورانه',
                        'replies' => []
                    ],
                    [
                        'name'    => 'پرهام طاهری',
                        'star'    => 4,
                        'comment' => 'با وجود نمره نامطلوبم در آیلتس، انگلیسی من بهتر شد. اگر طولانی ترباشد خیلی بهتر می شود.
                        ',
                        'replies' => []
                    ],
                    [
                        'name'    => 'زینب یوسفی',
                        'star'    => 4,
                        'comment' => 'من می توانم با مدرک این دوره برای برخی از دانشگاه های کانادا اقدام کنم. این عالی است.
                        ',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Language course - Landa Trip'
                        ],
                        "title"                   => "دوره آمادگی آزمون آیلتس زمستان 2022",
                        "start_date_tour"         => Carbon::parse('2025-02-01'),
                        "end_date_tour"           => Carbon::parse('2025-02-10'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 8,
                        "nights"                  => 7,
                        "start_registration_date" => Carbon::parse('2024-01-25'),
                        "end_registration_date"   => Carbon::parse('2024-02-10'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 650,
                        "status"                  => GroupStatusEnum::completed,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 1963,
                                "ending_location"   => 1965,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Language course - Landa Trip'
                        ],
                        "title"                   => "دوره آمادگی آزمون آیلتس بهار 2023",
                        "start_date_tour"         => Carbon::parse('2025-04-01'),
                        "end_date_tour"           => Carbon::parse('2025-04-10'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 18,
                        "days"                    => 4,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2024-02-25'),
                        "end_registration_date"   => Carbon::parse('2024-03-10'),
                        //'accommodation'        => 'Ecolodge and camping',
                        //"price"                  => 650,
                        "status"                  => GroupStatusEnum::canceled,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 1954,
                                "ending_location"   => 1956,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Language course - Landa Trip'
                        ],
                        "title"                   => "دوره آمادگی آزمون آیلتس زمستان 2023",
                        "start_date_tour"         => Carbon::parse('2025-09-01'),
                        "end_date_tour"           => Carbon::parse('2025-09-10'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 18,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-07-25'),
                        "end_registration_date"   => Carbon::parse('2025-08-10'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 650,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 1987,
                                "ending_location"   => 1985,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'astronomy-and-photography-of-the-nature.webp',
                    'image_type' => 'header',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'astronomy-and-photography-of-the-nature.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'astronomy-and-photography-of-the-nature.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'language_id'          => 3,
                'title'                => 'نجوم و عکاسی از طبیعت',
                'short_summary'        => 'به آسمان شب خیره شوید، با عکاسی روی رمز و راز کیهان شناور شوید تا خاطرات را حفظ کنید.
                ',
                'city_id'              => 1044,
                //'group_size'           => '8-14 people',
                ////'accommodation'        => 'Ecolodge and camping',
                //'meals'                => 'One Breakfast, One dinner, One lunch',
                //'transport'            => 'Private car',
                //'days'                 => 2,
                //'nights'               => 1,
                //'price'                     =>  2.95,
                'skills'               => 'Digital Marketing',
                'tour_overview'        => '<p>این تور برای همه علاقه مندان به عکاسی و نجوم است که معتقدند ثروت خود را در آسمان پیدا می کنند یا می خواهند حداقل یک شب از زندگی یکنواخت رهایی یابند.به مدار باشکوه سیارات به دور ستارگان مربوطه خود نگاه کنید و سعی کنید شگفتی هایی را که می توانید در کیهان مشاهده کنید، ثبت کنید.</p>',
                'highlights'           => [
                    [
                        'title' => 'آموزش گرفتن عکس های خوب از طبیعت
                        '
                    ],
                    [
                        'title' => 'آموزش رنگ بندی و ایجاد تعادل در طلوع و آفتاب
                        '
                    ],
                    [
                        'title' => 'عکس گرفتن با سه پایه در طبیعت
                        '
                    ],
                    [
                        'title' => 'تنظیم روشنایی و کنتراست در محیط های تاریک
                        '
                    ],
                    [
                        'title' => 'بهترین تاریخ ها را از ستاره شناسی پیدا کنید
                        '
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'روز اول: یک سفر کوتاه خوب را شروع کنید',
                        'description' => '<p>پس از آن کارگاه عکاسی ما بر روی عکاسی از طبیعت، حیوانات و اشیاء در طبیعت تمرکز خواهد کرد. با کادربندی پانوراما و لانگ شات تمرین زیادی داشته باشید. ما یک استراحت کوتاه برای ناهار داریم و به تمرین عکاسی قبل از آفتاب ادامه می دهیم. ما قصد داریم عکس های عالی از آفتاب و آسمان آبی-قرمز بگیریم.</p> <p>پس از آن کارگاه عکاسی ما بر روی عکاسی از طبیعت، حیوانات و اشیاء در طبیعت تمرکز خواهد کرد. با کادربندی پانوراما و لانگ شات تمرین زیادی داشته باشید. ما یک استراحت کوتاه برای ناهار داریم و به تمرین عکاسی قبل از آفتاب ادامه می دهیم. ما قصد داریم عکس های عالی از آفتاب و آسمان آبی-قرمز بگیریم.</p> <p>بعد از صرف شام کوتاه و زود هنگام در ساعات اولیه شب، تا طلوع آفتاب بیرون، در جنگل خواهیم بود. مربی به دانش‌آموزان کمک می کند تا سه‌پایه‌ها و دوربین را بگذارند و تصاویر شگفت‌انگیزی از سیارات منظومه زودیاک و سایر ستارگان ثبت کنند.</p>'
                    ],
                    [
                        'title'       => 'روز دوم: نیمه شب همه چیز است',
                        'description' => '<p>این روز از فعالیت های شب گذشته در فضای باز شروع شد. صبح ها بعد از طلوع آفتاب یک چرت کوتاه و قبل از ظهر یک صبحانه دیرهنگام داریم. همه دانش آموزان باید جمع شوند و تصاویر خود را در ویدئو پروژکتور نشان دهند و مربی تا وقت ناهار در مورد آنها نظر می دهد.</p> <p>خوردن یک ناهار خوشمزه حال و هوای شما را تغییر می دهد و آماده بازگشت با خاطرات و دانستنی های جدید و شیرین خواهید بود.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'اقامت در اقامتگاه بومگردی',
                    ],
                    [
                        'title' => 'یک وعده صبحانه',
                    ],
                    [
                        'title' => 'یک ناهار',
                    ],
                    [
                        'title' => 'یک شام',
                    ],
                    [
                        'title' => 'گواهینامه ها',
                    ],
                    [
                        'title' => 'بیمه',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'حمل و نقل'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "kavir-2022-04-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-07.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-08.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-09.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "نجوم و عکاسی از طبیعت",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => 'بیمه سفر برای هر نفر چقدر است؟',
                        'answer'   => 'حدود 100 میلیارد ریال (3000 دلار آمریکا) برای مصدومان و معلولیت های بدنی. و 2 برابر بیشتر از آن برای مرگ تصادفی.'
                    ],
                    [
                        'question' => 'چه مدارکی برای این پکیج تور ضروری است؟',
                        'answer'   => 'اگرچه گذرنامه تنها مدرک رسمی برای سفر شماست، اما داشتن مدیریت اجرایی 5 ساله برای مشارکت ضروری است.'
                    ],
                    [
                        'question' => 'چگونه می توانم دوره سفر خود را لغو کنم؟',
                        'answer'   => 'حداقل 12 روز قبل از حرکت باید سفر خود را لغو کنید. در این شرایط می توانید 70 درصد مبلغ پرداختی خود را پس بگیرید. پس از این تاریخ، متأسفانه امکان برگشت هیچ گونه پرداختی وجود ندارد.'
                    ],
                    [
                        'question' => 'آیا می توانم با شوهر یا همسرم سفر کنم؟ یا بچه هایم؟',
                        'answer'   => 'بله. این امکان وجود دارد که همسفرهایی با شما باشند. اما لطفا برای اقامت، بلیط هواپیما و ... با لاندا تریپ در ارتباط باشید'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'لیلا جعفری',
                        'star'    => 5,
                        'comment' => 'واقعا تجربه ای فراموش نشدنی برای من بود',
                        'replies' => []
                    ],
                    [
                        'name'    => 'علی محمدی',
                        'star'    => 4,
                        'comment' => 'من واقعا از این سفر لذت بردم. اطلاعات بسیار ارزشمندی را برای من فراهم می کند.',
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'خیلی ممنونم'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'آوا یوسفی',
                        'star'    => 5,
                        'comment' => 'من اخیراً با لاندا تریپ به یک تور رفتم و شگفت انگیز بود! راهنما آگاه بود و تجربه را بسیار سرگرم کننده کرد.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'سارا اسماعیلی',
                        'star'    => 3,
                        'comment' => 'این اولین باری بود که با لاندا تریپ به یک تور می رفتم و باید بگویم که فراتر از همه انتظاراتم بود به جز در وعده های غذایی.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'سهیل پارسی',
                        'star'    => 4,
                        'comment' => 'من به همراه خانواده ام به این تور رفتم و همه قبول کردیم که این مهم ترین نقطه تعطیلات ما بود.',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Nature Photography course - Landa Trip'
                        ],
                        "title"                   => "دوره عکاسی در طبیعت پاییز 2022",
                        "start_date_tour"         => Carbon::parse('2025-11-05'),
                        "end_date_tour"           => Carbon::parse('2025-11-06'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 7,
                        "nights"                  => 6,
                        "start_registration_date" => Carbon::parse('2025-10-25'),
                        "end_registration_date"   => Carbon::parse('2025-11-02'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 2.95,
                        "status"                  => GroupStatusEnum::soldOut,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 48,
                                "ending_location"   => 50,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Nature Photography course - Landa Trip'
                        ],
                        "title"                   => "دوره عکاسی در طبیعت زمستان 2023",
                        "start_date_tour"         => Carbon::parse('2025-02-19'),
                        "end_date_tour"           => Carbon::parse('2025-02-20'),
                        "min_capacity"            => 12,
                        "max_capacity"            => 18,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-15'),
                        //'accommodation'        => '3-Star Hotel',
                        //"price"                  => 2.95,
                        "status"                  => GroupStatusEnum::startSoon,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 36,
                                "ending_location"   => 40,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'Nature Photography course - Landa Trip'
                        ],
                        "title"                   => "دوره عکاسی در طبیعت بهار 2024",
                        "start_date_tour"         => Carbon::parse('2025-02-19'),
                        "end_date_tour"           => Carbon::parse('2025-02-20'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 15,
                        "nights"                  => 14,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-15'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 2.95,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 158,
                                "ending_location"   => 160,
                                'transport'         => 'Airport transport for arrival and departure',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ]
                ],
            ],
            [
                'header_pic'           => [
                    'url'        => 'think-strategically-and-make-your-ideas-a-reality.webp',
                    'image_type' => 'header',
                    'alt'        => 'Think Strategically and Make Your Ideas a Reality - Management Business Analysis - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'think-strategically-and-make-your-ideas-a-reality.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Think Strategically and Make Your Ideas a Reality - Management Business Analysis - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'think-strategically-and-make-your-ideas-a-reality.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Think Strategically and Make Your Ideas a Reality - Management Business Analysis - Landa Trip'
                ],
                'language_id'          => 3,
                'title'                => 'Think Strategically and Make Your Ideas a Reality',
                'short_summary'        => 'Understand the essentials of decision-making, strategic thinking, and project implementation success',
                'city_id'              => 793,
                //'group_size'           => '8 - 12',
                ////'accommodation'        => '4-Star Hotel',
                //'meals'                => '4 Breakfast, 2 lunch, and 1 dinner',
                //'transport'            => 'Airport transport for arrival and departure',
                //'days'                 => 5,
                //'nights'               => 4,
                //'price'                     =>  550,
                'skills'               => 'Management, Business Analysis',
                'tour_overview'        => '<p class=\'text-justify ml-3 mb-1\'>Lately, Economic chaos like the trade wars, the Covid-19 outbreak, the oil crisis, and Brexit have a great impact on businesses around the world, so how do think, and making-decision in these conditions?</p> <p class=\'text-justify ml-3 mb-1\'>Thinking strategically is the best approach for your personal and business life. It has a procedural flow that should be a habit in your mind. It considers all of the strengths, opportunities, threats, and weaknesses altogether.</p> <p class=\'text-justify ml-3 mb-1\'>In this course, you make a specific time for yourself and improve your mind and abilities far from all of detracting issues.</p>',
                'highlights'           => [
                    [
                        'title' => 'Develop your strategic thinking ability'
                    ],
                    [
                        'title' => 'Make strategic thinking a habit'
                    ],
                    [
                        'title' => 'How to be more agile and fit for today’s rapid changes'
                    ],
                    [
                        'title' => 'Increase the likelihood of success of your projects and professional life'
                    ],
                    [
                        'title' => 'How to have quick responses to problems'
                    ],
                    [
                        'title' => 'Change and upgrade your personal and professional framework'
                    ],
                ],
                'itineraries'          => [
                    [
                        'title'       => 'Day 1: Arrival and warm welcome',
                        'description' => '<p>The start of your journey is from Imam Khomeini International airport (IKA) with a light air trip (about 2 and half hours) to Istanbul airport (IST). Our vans are waiting for you at the airport to have a calm and safe transfer to the hotel.</p> <p>After a short rest, and placing baggage, we go sightseeing on Esteghlal Avenue (İstiklâl Caddesi) altogether. Our visit continues along this street and its monuments. like Çiçek Pasajı, Galatasaray High School, and etc. our walking is to the side of Narmanlı Han for dinner time.</p>'
                    ],
                    [
                        'title'       => 'Day 2: The start of the Education journey',
                        'description' => '<p>The breakfast will be served in the hotel, which is also near the classroom, so please attend the classroom before 9:30 am TRT time.</p> <p>On the first day, we have a short introduction to each other. It caused to make a friendly and cooperative atmosphere between students and the lecturer.</p> <p>The class will be until evening (17:00 local time TRT) with two break times and one lunch-time that is included in the tour package.</p>'
                    ],
                    [
                        'title'       => 'Day 3: Works best for the most',
                        'description' => '<p>This day is the turning point in your education journey, so please bring all of your ability to act. This day’s class will be held from 9:30 to 17:00 like yesterday but with a lot of class activity, queries, and examples.</p> <p>You should build your critical and strategic approach in your mind. You should do it repeatedly to make it from a thinking way to a habit.</p>'
                    ],
                    [
                        'title'       => 'Day 4: Time and Opportunities Are Running out',
                        'description' => '<p>This day is the last day of your class. The class is part-time (from 9:30 morning to 13:00 TRT local time) and will be ended before lunchtime.</p> <p>After that, you are free for your leisure time until night. We will have a delicious dinner for the goodbye party on the last night of this course and in this beautiful city.</p>'
                    ],
                    [
                        'title'       => 'Day 5: The last seconds',
                        'description' => '<p>After breakfast, All of the student travelers are ready for departure at the airport.</p> <p>A group photo, new friends, new connections, and certifications will be the best souvenirs from this journey for yourself and your business.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'Airplane ticket (two ways)',
                    ],
                    [
                        'title' => 'Accommodation in 4 stars hotel',
                    ],
                    [
                        'title' => 'Airport transportation',
                    ],
                    [
                        'title' => '4 breakfasts',
                    ],
                    [
                        'title' => '2 lunches',
                    ],
                    [
                        'title' => '1 dinner',
                    ],
                    [
                        'title' => 'Course and certifications',
                    ],
                    [
                        'title' => 'Insurance',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'Departure taxes from Iran'
                    ],
                    [
                        'title' => 'Imam Khomeini airport transportation'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "strategically-course-1.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-2.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-3.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-4.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-5.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-6.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-7.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-8.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-9.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "strategically-course-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                ],
                'map'                  => 'https://',
                //                'certificates'         => [
                //                    [
                //                        'title'            => "Think Strategically and Make Your Ideas a Reality",
                //                        'certificate_type' => "Certification of participation"
                //                    ]
                //                ],
                'terms_and_conditions' => [
                    [
                        'question' => 'How much is the insurance for the travel for each person?',
                        'answer'   => 'about 100 billion rials (3,000 US dollars) for injured and bodily disabilities. And 2x more of that for accidental death.'
                    ],
                    [
                        'question' => 'What documents are essential for this tour package?',
                        'answer'   => 'Although a passport is the only official document for your travel, having 5-year executive management is necessary for participation.'
                    ],
                    [
                        'question' => 'How can I cancel my travel course?',
                        'answer'   => 'You should cancel your travel at least 12 days before departure. In this condition, you can pay back 70% of your payment. After this date, unfortunately, it isn’t possible to return any payment.'
                    ],
                    [
                        'question' => 'Can I travel with my husband/wife? Or my children?',
                        'answer'   => 'Yes. It’s possible to have fellow–travelers with you. But please check with Landa trip for accommodation, an airplane ticket, and so on.'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'Ali',
                        'star'    => 4,
                        'comment' => 'It was amazing leisure and educational time for me. The behavior of tutor was so respectful. The only issue was the lack of free time in Istanbul.',
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'Thanks for your comment.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Sam',
                        'star'    => 5,
                        'comment' => 'This travel course changes my mind. I feel upgraded in my thinking way to the world',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Sara',
                        'star'    => 3,
                        'comment' => 'The course was fantastic, but the distance between the hotel and the classroom was long for me.',
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'Thanks your a lot.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'Parsa',
                        'star'    => 4,
                        'comment' => 'Just magnificent mate.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Soheil',
                        'star'    => 5,
                        'comment' => 'This course was elegant work dude.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'Melika',
                        'star'    => 5,
                        'comment' => 'I want to learn this kind of style! Teach me more.',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'تفکر استراتژیک برای شرکت های مبتنی بر خدمات - Landa Trip'
                        ],
                        "title"                   => "تفکر استراتژیک برای شرکت های مبتنی بر خدمات بهار 2023",
                        "start_date_tour"         => Carbon::parse('2025-02-01'),
                        "end_date_tour"           => Carbon::parse('2025-02-10'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-25'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 550,
                        "status"                  => GroupStatusEnum::preRegistration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 652,
                                "ending_location"   => 652,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'تفکر استراتژیک برای شرکت های مبتنی بر خدمات - Landa Trip'
                        ],
                        "title"                   => "تفکر استراتژیک برای شرکت های مبتنی بر خدمات بهار 2024",
                        "start_date_tour"         => Carbon::parse('2026-02-01'),
                        "end_date_tour"           => Carbon::parse('2026-02-10'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 9,
                        "nights"                  => 8,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-25'),
                        //'accommodation'        => 'Ecolodge and camping',
                        //"price"                  => 610,
                        "status"                  => GroupStatusEnum::onGoing,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 659,
                                "ending_location"   => 658,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'header_pic'           => [
                    'url'        => 'take-a-shot-from-the-unknown-world.webp',
                    'image_type' => 'header',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'thumbnail_pic'        => [
                    'url'        => 'take-a-shot-from-the-unknown-world.png',
                    'image_type' => 'thumbnail',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'brochure_pic'         => [
                    'url'        => 'take-a-shot-from-the-unknown-world.webp',
                    'image_type' => 'brochure',
                    'alt'        => 'Photography course in the desert - Digital Marketing - Landa Trip'
                ],
                'language_id'          => 3,
                'title'                => 'از دنیای ناشناخته عکس بگیرید',
                'short_summary'        => 'دوره عکاسی عملی در فضای باز برای بازاریابان دیجیتال و اینفلوئنسرها',
                'city_id'              => 12,
                //'group_size'           => '12-15 people',
                ////'accommodation'        => 'Ecolodge and camping',
                //'meals'                => 'Two Breakfast, One dinner, Two lunch',
                //'transport'            => 'Charter van or bus',
                //'days'                 => 2,
                //'nights'               => 1,
                //'price'                     =>  75,
                'skills'               => 'Digital Marketing',
                'tour_overview'        => '<p>عکاسی یک نکته برجسته در بازاریابی دیجیتال است. بنابراین اگر نیاز دارید مهارت خود را در آن توسعه دهید. توصیه می کنیم با یک دوره عملی، نه فقط تئوری، روی تکنیک های عکاسی خود تمرکز کنید.</p> <p>خوشبختانه، چه یک دوربین گران قیمت DSLR یا یک گوشی هوشمند متوسط ​​داشته باشید، در این دوره آموزشی اصول ترکیب بندی برای ایجاد محتوا در یک مستند کاوشگر را خواهید آموخت.</p> <p>این دوره همچنین فراتر از موضوعات "فنی" است و نحوه ایجاد تصاویر هیجان انگیز را با تاکید بر جنبه های Vantage Point برای تفسیر موضوعات قدیمی مانند ساختمان های تاریخی و محله ها به روش های جدید آموزش می دهد.</p> <p>عکاسی در فضای باز اغلب دارای شرایط غیرمنتظره ای است، بنابراین شناخت لوازم جانبی که عکاسان، مفید می دانند و انواع کیف های دوربین، از اندازه کوچک گرفته تا دستی که می تواند به شما کمک کند، نیز برای شما آماده است.</p>',
                'highlights'           => [
                    [
                        'title' => 'با تکنیک های عکاسی از عکاسان حرفه ای آشنا شوید'
                    ],
                    [
                        'title' => 'از درس ها و سرگرمی های فراوان زیر نظر یک راهنمای حرفه ای لذت ببرید'
                    ],
                    [
                        'title' => 'حرفه آموزشی را تجربه کنید'
                    ],
                    [
                        'title' => 'درگیر تجربه های نادر شوید'
                    ],
                    [
                        'title' => 'دوستان جدید پیدا کنید'
                    ],
                    [
                        'title' => 'اقامت در اقامتگاه های با کیفیت'
                    ],
                    [
                        'title' => 'در گشت و گذارهای فوق العاده به محیط اطراف خود لذت ببرید'
                    ],
                    [
                        'title' => 'فرصتی برای کشف یک کشور زیبا داشته باشید'
                    ],
                    [
                        'title' => 'از فعالیت های عملی و همه جانبه لذت ببرید'
                    ]
                ],
                'itineraries'          => [
                    [
                        'title'       => 'روز اول: شروع ماجراجویی:',
                        'description' => '<p>تور ما از صبح زود شروع می شود زیرا پس از یک سفر کوتاه به روستای قرنه، روستای تاریخی و زیبای اصفهان، کار زیادی برای انجام دادن داریم. ما در آنجا توقفی برای صبحانه و بخش اولیه دوره های عکاسی داریم. این مکان برای تمرینات محیط روستایی و شهری ما است. می توانید مکان های سرپوشیده و مناطق بسته در فضای باز را تحت نظارت مربی خود امتحان کنید.</p> <p>پس از آن در یکی از خانه های تاریخی ناهار می خوریم و به باغ های روستا می رویم. ما سوژه های طبیعی را برای عکاسی امتحان می کنیم، از جانوران و گیاهان، خزندگان و پستانداران گرفته تا پرندگان.-ما نباید یک گردهمایی فوق‌العاده در اطراف آتش را در شب با نوشیدنی‌ها و یک شام سبک در محیط زیبا از دست بدهیم.</p>'
                    ],
                    [
                        'title'       => 'روز دوم: بازگشت ناراحت کننده :',
                        'description' => '<p>روز ما قبل از طلوع خورشید شروع می شود، بنابراین عکس های شگفت انگیزی از آن را در چشم انداز بینظیر از دست ندهید. شما می توانید این پرتوهای نور جادویی را که از میان تپه های شنی بیرون می آیند با راهنمایی مربی ما ثبت کنید. صبحانه در کویر یک تجربه بی نظیر است که دیگر هرگز آن را نخواهید یافت.</p> <p>گم شدن در بیابان، به دور از هر فرد یا روستایی، تنها با یک دیفرانسیل متحرک، ناآرامی خود را آرام کنید. شما آزاد هستید که به همه جا و در هر جهت بروید. شما تنها هستید. از هر لحظه لذت ببر. </p> <p>عصر آخرین گردهمایی مختص گرفتن عکس گروهی با دوستان جدیدمان است. برای همیشه در حافظه شما باقی خواهد ماند.</p>'
                    ]
                ],
                'includes'             => [
                    [
                        'title' => 'اتوبوس چارتر',
                    ],
                    [
                        'title' => 'اقامت در بومگردی',
                    ],
                    [
                        'title' => 'دو وعده صبحانه، یک وعده شام، دو وعده ناهار',
                    ],
                    [
                        'title' => 'دوره و گواهینامه',
                    ],
                    [
                        'title' => 'بیمه',
                    ]
                ],
                'excludes'             => [
                    [
                        'title' => 'دوربین و تجهیزات'
                    ]
                ],
                'gallery'              => [
                    [
                        "url"        => "kavir-2022-04-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kavir-2022-04-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-01.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-02.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-03.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-04.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-05.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-06.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-07.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-08.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-09.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-10.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-11.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ],
                    [
                        "url"        => "kashan-2023-01-12.webp",
                        "alt"        => "",
                        "image_type" => ""
                    ]
                ],
                'map'                  => 'https://',
                //                'certificates'         =>
                //                    [
                //                        [
                //                            'title'            => "از دنیای ناشناخته عکس بگیرید",
                //                            'certificate_type' => "Certification of participation"
                //                        ]
                //                    ],
                'terms_and_conditions' => [
                    [
                        'question' => 'بیمه سفر برای هر نفر چقدر است؟',
                        'answer'   => 'حدود 100 میلیارد ریال (3000 دلار آمریکا) برای مصدومان و معلولیت های بدنی. و 2 برابر بیشتر از آن برای مرگ تصادفی.'
                    ],
                    [
                        'question' => 'چه مدارکی برای این پکیج تور ضروری است؟',
                        'answer'   => 'اگرچه گذرنامه تنها مدرک رسمی برای سفر شماست، اما داشتن مدیریت اجرایی 5 ساله برای مشارکت ضروری است.'
                    ],
                    [
                        'question' => 'چگونه می توانم دوره سفر خود را لغو کنم؟',
                        'answer'   => 'حداقل 12 روز قبل از حرکت باید سفر خود را لغو کنید. در این شرایط می توانید 70 درصد مبلغ پرداختی خود را پس بگیرید. پس از این تاریخ، متأسفانه امکان برگشت هیچ گونه پرداختی وجود ندارد.  '
                    ],
                    [
                        'question' => 'آیا می توانم با شوهر یا همسرم سفر کنم؟ یا بچه های من؟',
                        'answer'   => 'بله،  این امکان وجود دارد که همسفرهایی با شما باشند. اما لطفا برای اقامت، بلیط هواپیما و ... با لاندا تریپ در ارتباط باشید.'
                    ]
                ],
                //'dates'                => '',
                'comments'             => [
                    [
                        'name'    => 'مهدی رحیمی',
                        'star'    => 5,
                        'comment' => 'این یک دوره زیبا برای سفر است. در سفر سرگرم کننده خود، نکات بسیاری را یاد می گیرید. آن را از دست ندهید.',
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'متشکرم'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'اوا یوسفی',
                        'star'    => 5,
                        'comment' => 'دوباره امتحان خواهم کرد.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'زینب یوسفی',
                        'star'    => 4,
                        'comment' => 'پیشنهاد می کنم به آن بروید، اما بهار بهتر است',
                        'replies' => [
                            [
                                'name'  => 'Landa Trip',
                                'reply' => 'بله، برخی از فصل ها بهتر است، اما ما برای راحتی شما تهویه مطبوع در اتوبوس یا بومگردی داریم.'
                            ]
                        ]
                    ],
                    [
                        'name'    => 'رضا باقری',
                        'star'    => 3,
                        'comment' => 'فعالیت های زیادی دارد که شما را خسته می کند.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'لیلا جعفری',
                        'star'    => 4,
                        'comment' => 'دو بار امتحان کردم هر بار تجربه متفاوتی دارد',
                        'replies' => []
                    ],
                    [
                        'name'    => 'محمد صالحی',
                        'star'    => 5,
                        'comment' => 'فکر کنم دارم خواب میبینم این شگفت انگیز است. من نمی توانم آن را باور کنم.',
                        'replies' => []
                    ],
                    [
                        'name'    => 'سهیل پارسی',
                        'star'    => 4,
                        'comment' => 'همراه داشتن لباس گرم در زمستان و شب را فراموش نکنید.',
                        'replies' => []
                    ]
                ],
                'tour_brochure'        => '',
                'status'               => TourStatusEnums::approved,
                'groups'               => [
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-01.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'دوره عکاسی - Landa Trip'
                        ],
                        "title"                   => "عکاسی در طبیعت 2022",
                        "start_date_tour"         => Carbon::parse('2026-12-01'),
                        "end_date_tour"           => Carbon::parse('2026-12-02'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 3,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-10-25'),
                        "end_registration_date"   => Carbon::parse('2025-11-25'),
                        //'accommodation'        => '5-Star Hotel',
                        //"price"                  => 70,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 785,
                                "ending_location"   => 782,
                                'transport'         => 'Private car',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],
                            ]
                        ]
                    ],
                    [
                        // 'currency_id'            => 4,
                        'thumbnail_pic'           => [
                            'url'        => 'test-02.webp',
                            'image_type' => 'thumbnail',
                            'alt'        => 'دوره عکاسی - Landa Trip'
                        ],
                        "title"                   => "عکاسی در طبیعت 2023",
                        "start_date_tour"         => Carbon::parse('2026-02-25'),
                        "end_date_tour"           => Carbon::parse('2026-02-26'),
                        "min_capacity"            => 9,
                        "max_capacity"            => 18,
                        "days"                    => 5,
                        "nights"                  => 4,
                        "start_registration_date" => Carbon::parse('2025-01-25'),
                        "end_registration_date"   => Carbon::parse('2025-02-18'),
                        //'accommodation'        => '4-Star Hotel',
                        //"price"                  => 70,
                        "status"                  => GroupStatusEnum::registration,
                        "tutors"                  => [],
                        "users"                   => [],
                        "posts"                   => [],
                        "start_points"            => [
                            [
                                "starting_location" => 165,
                                "ending_location"   => 156,
                                'transport'         => 'Charter van or bus',
                            ]
                        ],
                        "group_itineraries"       => [
                            [
                                "breakfast" => false,
                                "lunch"     => true,
                                "snack"     => true,
                                "dinner"    => true,

                                "accommodation" =>
                                    [
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 658
                                        ],
                                        [
                                            "hotel_grade" => 3,
                                            "city"        => 690
                                        ]
                                    ],

                                "transportations" =>
                                    [
                                        [
                                            "from" => 458,
                                            "to"   => 452,
                                            "by"   => "bus"
                                        ],
                                        [
                                            "from" => 758,
                                            "to"   => 785,
                                            "by"   => "train"
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ]
            ],
        ];

        foreach ($items as $item) {
            $tourObj = new Tour($item);
            unset($tourObj['highlights'], $tourObj['itineraries'], $tourObj['includes'], $tourObj['includes'], $tourObj['excludes'], $tourObj['gallery'], $tourObj['terms_and_conditions'], $tourObj['comments'], $tourObj['header_pic'], $tourObj['thumbnail_pic'], $tourObj['brochure_pic'], $tourObj['groups']);
            $tourObj->tour_brochure = strtolower(str_replace(" ", "-", trim($tourObj->title))) . '.pdf';
            $tourObj->user_id = User::whereHasRole('teacher')->inRandomOrder()->first()->id;
            $tourObj->teacher_name = User::whereHasRole('teacher')->inRandomOrder()->first()->name;
            $tourObj->certification_id = Certification::inRandomOrder()->first()->id;
            $tourObj->withoutEvents(function () use ($tourObj) {
                $tourObj->id = $tourObj->newUniqueId();
                $tourObj->slug = $tourObj::makeSlug($tourObj->title);
                $tourObj->save();
            });

            $imageObj = new Image($item['header_pic']);
            $tourObj->images()->save($imageObj);

            $imageObj = new Image($item['thumbnail_pic']);
            $tourObj->images()->save($imageObj);

            $imageObj = new Image($item['brochure_pic']);
            $tourObj->images()->save($imageObj);

            foreach ($item['highlights'] as $highlight) {
                $highlightObj = new TourHighlight($highlight);
                $tourObj->tourHighlights()->save($highlightObj);
            }

            foreach ($item['itineraries'] as $itinerary) {
                $itineraryObj = new TourItinerary($itinerary);
                $tourObj->tourItineraries()->save($itineraryObj);
            }

            foreach ($item['includes'] as $include) {
                $includeObj = new TourInclude($include);
                $tourObj->tourIncludes()->save($includeObj);
            }

            foreach ($item['excludes'] as $exclude) {
                $excludeObj = new TourExclude($exclude);
                $tourObj->tourExcludes()->save($excludeObj);
            }

            if ($item['gallery']) {
                foreach ($item['gallery'] as $gallery) {
                    $galleryObj = new TourGallery($gallery);
                    $tourObj->gallery()->save($galleryObj);
                }
            }

//            foreach ($item['certificates'] as $certificate) {
//                $certificateObj = new Certification($certificate);
//                //$certificateObj->user()->associate(User::whereRoleIs('teacher')->inRandomOrder()->first());
//                $tourObj->certificate()->save($certificateObj);
//            }

            foreach ($item['terms_and_conditions'] as $term) {
                $termObj = new TermAndCondition($term);
                $tourObj->termAndCondition()->save($termObj);
            }

            $languageObj = Language::find($item['language_id']);

            foreach ($item['comments'] as $comment) {
                $commentObj = new TourComment($comment);
                unset($commentObj['replies'], $commentObj['name']);
//                $userObj = User::where("fname", strtolower($comment['name']))->first();
                $userObj = User::whereHasRole('user')->inRandomOrder()->first();
                $commentObj->user()->associate($userObj);
                $commentObj->tour()->associate($tourObj);
                $commentObj->verify_at = Carbon::now();
                $commentObj->language()->associate($languageObj);
                $commentObj->saveQuietly();

                $users = User::inRandomOrder()->limit(7)->get();
                foreach ($users as $user) {
                    $tourCommentLikeObj = new TourCommentLike();
                    $tourCommentLikeObj->user()->associate($user);
                    $commentObj->tourCommentLikes()->save($tourCommentLikeObj);
                }

                foreach ($comment['replies'] as $reply) {
                    $replyObj = new TourCommentReply($reply);
                    unset($replyObj['name']);
                    $userObj = User::where("fname", strtolower($reply['name']))->first();
                    $replyObj->user()->associate($userObj);
                    $replyObj->verify_at = Carbon::now();
                    $replyObj->tourComment()->associate($commentObj);
                    $replyObj->saveQuietly();

                    $users = User::inRandomOrder()->limit(7)->get();
                    foreach ($users as $user) {
                        $tourCommentReplyLikeObj = new TourCommentReplyLike();
                        $tourCommentReplyLikeObj->user()->associate($user);
                        $replyObj->tourCommentReplyLikes()->save($tourCommentReplyLikeObj);
                    }
                }
            }

            // group
            foreach ($item['groups'] as $group) {
                $groupObj = new Group($group);
                unset($groupObj['thumbnail_pic'], $groupObj['users'], $groupObj['posts'], $groupObj['tutors'], $groupObj['start_points'], $groupObj['group_itineraries']);
                $groupObj->language_id = $tourObj->language_id;
                $groupObj->tour()->associate($tourObj);
                $groupObj->withoutEvents(function () use ($groupObj) {
                    $groupObj->id = $groupObj->newUniqueId();
                    $groupObj->slug = $groupObj::makeSlug($groupObj->title);
                    $groupObj->save();
                });


                $imageObj = new Image($group['thumbnail_pic']);
                $groupObj->images()->save($imageObj);

                // start_points
                foreach ($group['start_points'] as $transportation) {
                    $transportationObj = new StartPoint($transportation);
                    $transportationObj->group()->associate($groupObj);
                    $transportationObj->save();
                }
                foreach ($group['group_itineraries'] as $itinerary) {
                    $itineraryObj = new GroupItinerary($itinerary);
                    unset($itineraryObj['accommodation'], $itineraryObj['transportations']);
                    $itineraryObj->group()->associate($groupObj);
                    $itineraryObj->save();

                    foreach ($itinerary['accommodation'] as $accommodation) {
                        $accommodationObj = new GroupItineraryTeacherAccommodation($accommodation);
                        $accommodationObj->groupItinerary()->associate($itineraryObj);
                        $accommodationObj->save();
                    }

                }


                // Tutors for group
                $tutors = User::whereHasRole('teacher')->inRandomOrder()->limit(random_int(1, 3))->get();
                foreach ($tutors as $tutor) {
                    $groupTutor = new GroupTutor;
                    $groupTutor->user()->associate($tutor);
                    $groupObj->groupTutors()->save($groupTutor);
                }

                // Users of each group
                $randUsers = User::whereHasRole('user')->inRandomOrder()->limit(random_int($groupObj->min_capacity, $groupObj->max_capacity))->get();
                foreach ($randUsers as $randUser) {
                    $groupObj->users()->attach($randUser, ["status" => array_rand(GroupUserStatusEnum::getValues())]);
                    if ($groupObj->users()->count() === $groupObj->max_capacity) {
                        $groupObj->status = GroupUserStatusEnum::getValue("completed");
                        $groupObj->save();
                    }
                }

                if ($groupObj->status->value === GroupStatusEnum::completed) {
                    $ratedUsers = $groupObj->users()->wherePivot("status", "=", GroupUserStatusEnum::completed)->inRandomOrder()->get();

                    if ($ratedUsers) {
                        foreach ($ratedUsers as $ratingUser) {
                            $filteredUsers = $ratedUsers->filter(function ($user) use ($ratingUser) {
                                return $user->id !== $ratingUser->id;
                            });

                            foreach ($filteredUsers as $ratedUser) {
                                $count = UserRating::where([
                                    ["group_id", "=", $groupObj->id],
                                    ["user_id", "=", $ratingUser],
                                ])->count();

                                if ($count < 3) {
                                    $userRatingObj = new UserRating([
                                        "group_id"      => $groupObj->id,
                                        "user_id"       => $ratingUser->id,
                                        "user_rated_id" => $ratedUser->id
                                    ]);
                                    $userRatingObj->saveQuietly();
                                }
                            }
                        }

                    }
                }

//                // Certificate of Users in group
//                $userCertificateObj = new UserCertificate();
//                $userCertificateObj->user()->associate($randUser);
//                $userCertificateObj->status = array_rand(CertificationStatusEnum::getValues());
//                $userCertificateObj->group()->associate($groupObj);
//                $userCertificateObj->certification()->associate($groupObj->tour()->first()->certificate()->inRandomOrder()->first());
//                $userCertificateObj->saveQuietly();
            }

            // Post in group
            foreach ($groupObj->users()->inRandomOrder()->get() as $userWriter) {
                $groupUserPost = GroupPost::factory()->makeOne();
                $groupUserPost->user()->associate($userWriter);
                $groupObj->groupPosts()->save($groupUserPost);
            }

            // User Rating for Badges

//                for ($i=0; $i<random_int(11,15); $i++) {
//                    $groupUserPost = GroupPost::factory()->makeOne();
//                    $groupUserPost->user()->associate($groupObj->users()->inRandomOrder()->first());
//                    $groupObj->groupPosts()->save($groupUserPost);
//                }

        }

    }
}
