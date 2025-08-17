<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Image;
use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
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
                "title"       => "Public",
                "fontawesome" => "fa-earth-americas",
                "language_id" => 1,
                "articles"    => [
                    [
                        "title"           => "What is Landa Trip?",
                        "body"            => "<p class='fs-4 ms-4'>Landa trip is an innovative start-up company that creates, promotes, and runs useful educational courses for all interested people and businesses. These courses have a wide range from soft to hard and academic skills. These courses are held in many countries and are selected among the best institutes and lecturers in each field and specialty. We have defined standards for all travel and education courses. Our mission is to meet all quality and performance standards. So, our endeavor is to create the best services for hassle-free travel for you.</p><h2 class='mt-10 text-xl font-bold mb-5'>Why should I choose Landa Trip</h2><p class='fs-4 ms-4'>Landa Trip is an online platform with the best options and offers for its users. In the following, we mention some of the most convincing reasons for choosing landa trip platform.</p><ul><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa trip Save your cost</h3><p class='fs-4 ms-3'>In the tours run by Landa Trip, both students and teachers save cost. The student’s cost decreases by dividing money among the group members. As a result, the teacher’s income will be increased by raising the student’s numbers.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Join into a peer group with landa trip</h3><p class='fs-4 ms-3'>In landa trip tours, you will be added to a peer group which is related to your profession or the field in which you are trained. It helps you to collaborate with your group members and grow up with the help of your peer group.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa trip expands your connections</h3><p class='fs-4 ms-3'>Landa Trip expands your local and international connections. As a student, you will find people with the same goals and skills and as a teacher, you will cooperate with other professional teachers and you can boost your experience and expand your connections.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Visa and travel management with Landa Trip</h3><p class='fs-4 ms-3'>By adding to the landa trip platform, every action about travel management will be done by the landa trip professional team.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Payment guarantee by Landa Trip</h3><p class='fs-4 ms-3'>With landa trip, you will experience a safe payment and transaction. You will never have any concern about your financial payments. The cost of your tour will be kept during the whole trip, and if a problem occurs, the cost will be returned according to the law. For more information, call our experts.</p></li></ul><h2 class='mt-10 text-xl font-bold mb-5'>What are the benefits of Landa Trip</h2><ul class='fs-4'><li>Extensive network</li><li>Variety of tours</li><li>Competitive market among the best international teachers around the world</li><li>Save and reduce costs by dividing and sharing costs in the group</li><li>Traveling with people with the same and common goals and professions</li><li>Amazing times with other companions</li><li>A valid certificate which can be shared in linked-in</li></ul><h2 class='mt-10 text-xl font-bold mb-5'>Who is the Landa Trip platform for</h2><p class='fs-4 ms-4'>Landa trip platform is used by various groups of people including students, teachers, travel agencies, etc. In the following, we will mention and explain all of them for you.</p><ul><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa trip platform for students</h3><p class='fs-4 ms-3'>The students can acquire new skills and get acquainted with the labor. market in a practical way from the best tutors and employees.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa trip platform for teachers</h3><p class='fs-4 ms-3'>If you are a teacher and you want to increase your knowledge, experience and expand your connections, landa trip platform is the best choice for you.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa trip for travel agencies</h3><p class='fs-4 ms-3'>Landa Trip also has good offers for travel agencies. They can earn a lot of profit by bulk selling their tours through cooperation with Landa Trip.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa trip for public and private sector employers</h3><p class='fs-4 ms-3'>Obtaining new skills coincide with updating and upgrading expertise to improve personal and cooperation level for one group of the employers. Landa trip will help you to reach your goals.</p></li><li><h3 class='text-xl font-bold mt-10 mb-5'>Landa trip for interested Persons</h3><p class='fs-4 ms-3'>Landa Trip can be used by interested people or those who are willing to be a part of our platform. Fill in the gap between university and the labor market with some skills that aren't taught in the universities, like soft and practical skills.</p></li></ul><h2 class='mt-10 text-xl font-bold mb-5'>How does the Landa trip platform work</h2><p class='fs-4 ms-4'>Landa Trip is an online platform where students and teachers can register separately on the website. As a student or teacher, you should fill out the form and complete your personal profile to make an AI or match making model that helps you with the best suggestions. In landa trip, you are evaluated with the help of artificial intelligence and the best offers will be provided for you. Also, according to your background and interests, Landa Trip will form the most appropriate group for you.</p>",
                        "description"     => "Landa trip is an innovative start-up company that creates, promotes, and runs useful educational courses for all interested people and businesses. These courses have a wide range from soft to hard and academic skills. These courses are held in many countries and are selected among the best institutes and lecturers in each field and specialty. We have defined standards for all travel and education courses. Our mission is to meet all quality and performance standards. So, our endeavor is to create the best services for hassle-free travel for you.",
                        "short_text"      => "Landa trip is an innovative start-up company that creates, promotes, and runs useful educational courses for all interested people and businesses. These courses have a wide range from soft to hard and academic skills. These courses are held in many countries and are selected among the best institutes and lecturers in each field and specialty. We have defined standards for all travel and education courses. Our mission is to meet all quality and performance standards. So, our endeavor is to create the best services for hassle-free travel for you.",
                        "reading_time"    => "10",
                        "keywords"        => "landatrip, educational trip, ",
                        "header_pic"      => [
                            'url'        => "rectangle-2819.webp",
                            'image_type' => "header",
                            'alt'        => "",
                        ],
                        "thumbnail_image" => [
                            'url'        => "rectangle-2823.webp",
                            'image_type' => "thumbnail",
                            'alt'        => "",
                        ],
                    ],
                    [
                        "title"        => "How Landa Trip works?",
                        "body"         => "<p class='fs-4 ms-4'>As we mentioned in the article what is Landa trip, Landa trip is an innovative start-up company that creates, promotes, and runs useful educational courses for all interested people and businesses. In this company, we are trying to make useful connections between students and teachers in different fields during our amazing educational tour. Do you know How Landa Trip works? In this article, we will tell you everything about Landa Trip and the way of its working. Stick around till the end of the article. What is Landa Trip</p><h2 class='mt-10 text-xl font-bold mb-5'>Who are the Landa Trip students</h2><p class='fs-4 ms-4'>Landa Trip students refer to individuals who participate in optional field training with tours run by Landa Trip. On one hand, they become professionals in their respective fields, and on the other hand, they experience unforgettable memories with Landa Trip tours. Are you willing to become a member of Landa Trip Students?</p><h2 class='mt-10 text-xl font-bold mb-5'>Who are the Landa Trip teachers</h2><p class='fs-4 ms-4'>Landa Trip teachers refer to individuals who organize educational tours and share them on the Landa Trip platform. They teach students who have applied for training at Landa Trip. Are you willing to become a member of Landa Trip Teachers?</p><ul><li><h3 class='text-xl font-bold mt-10  mb-5'>Membership in Landa Trip</h3><p class='fs-4 ms-2'>The first step to cooperate with Landa Trip is to complete the registration process in the system. You can contact our experts to get information and registration guides. As we mentioned, everything that is needed for you to be a part of the Landa Trip Group and expand your knowledge is to fill out the registration form on our website and complete your profile information.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Project registration steps of Landa Trip</h3><p class='fs-4 ms-2'>Depending on your position as a teacher or a student, you have a different registration process in Landa Trip Platform. If you are a teacher, you must completely explain your resume, your field of study, your profession, and everything needed for being accepted on the Landa Trip platform. But if you are a student, you should complete your profile and all the information related to your skills and the profession in which you want to learn. The more accurate and detailed information you provide, the easier it will be for Landa Trip Experts to help you join your peer group.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Fill out the form</h3><p class='fs-4 ms-2'>Fill out the form carefully so that artificial intelligence can provide you better offers based on your expertise. Try to mention different parts of your knowledge, the field of study, or everything you want us to provide for you.</p></li></ul><h2 class='mt-10 text-xl font-bold mb-5'>Landa Trip Works On</h2><p class='fs-4 ms-4'>Landa Trip works on different items. These items include supplying professional teachers and volunteered students, advanced courses, valid certification, etc. For more information, follow us to the end.</p><ul><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa Trip works on supplying teachers</h3><p class='fs-4 ms-2'>Landa Trip works on supplying professional teachers from all over the world. Our goal is to provide the best courses in the world with the most specialist teachers.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa Trip Works on supplying students</h3><p class='fs-4 ms-2'>As we mentioned, we are trying to find enthusiastic students to expand their knowledge and increase their experience during our amazing tours.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa Trip works on the security of payments</h3><p class='fs-4 ms-2'>Landa Trip tries to make you feel sure about the security of payments. With Landa Trip, you can do your transactions without any worries. We provide a platform for you which allows you to deposit or receive your payments with the highest level of security.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa Trip works on technical supports</h3><p class='fs-4 ms-2'>Landa Trip goes along in all steps of your activity, whether you join as a teacher, a student, or even as an ordinary person seeking to enhance their experience or knowledge. In all of these situations, Landa Trip assists you with its team of professional experts. We assure you that wherever you need specialized consultation, our Specialists will help you and never leave you in this challenging route.</p></li></ul><h2 class='mt-10 text-xl font-bold mb-5'>Valid certificate in Landa Trip</h2><p class='fs-4 ms-4'>By receiving your valid certificate after passing Landa Trip Courses, your resume will become more substantial. If you have a question, call our experts.</p>",
                        "description"  => "As we mentioned in the article what is Landa trip, Landa trip is an innovative start-up company that creates, promotes, and runs useful educational courses for all interested people and businesses. In this company, we are trying to make useful connections between students and teachers in different fields during our amazing educational tour. Do you know How Landa Trip works? In this article, we will tell you everything about Landa Trip and the way of its working. Stick around till the end of the article.",
                        "short_text"   => "As we mentioned in the article what is Landa trip, Landa trip is an innovative start-up company that creates, promotes, and runs useful educational courses for all interested people and businesses. In this company, we are trying to make useful connections between students and teachers in different fields during our amazing educational tour. Do you know How Landa Trip works? In this article, we will tell you everything about Landa Trip and the way of its working. Stick around till the end of the article.",
                        "reading_time" => "10",
                        "keywords"     => "How Landa Trip works?",
                        "header_pic"      => [
                            'url'        => "astronomy-and-photography-of-the-nature.webp",
                            'image_type' => "header",
                            'alt'        => "",
                        ],
                        "thumbnail_image" => [
                            'url'        => "rectangle-2821.webp",
                            'image_type' => "thumbnail",
                            'alt'        => "",
                        ],

                    ],
                    [
                        "title"        => "Benefits of educational traveling?",
                        "body"         => "<p class='fs-4 ms-4'>Educational traveling refers to the practice of traveling to different places with the purpose of gaining knowledge and having fun and expanding your connections with peer companions. Educational traveling has many benefits for both students and teachers. Education in traveling provides an opportunity to learn deeply and practical during your journey. Every aspect of travel teaches students new soft and hard skills, which they are unlikely to gain in usual situations. Also, educational travel offers students appropriate opportunities to gain valuable insights about the world. Here, we list some of the valuable advantages of education while traveling.</p><h2>The world's best teachers in Landa Trip</h2><p class='fs-4 ms-4'>Landa Trip collaborates with the finest teachers and institutions from all over the world and equipping them with the newest Educational methods. Would you like to join the Landa Trip Platform?</p><ul><li><h3 class='text-xl font-bold mt-10  mb-5'>Exchange Ideas in Landa Trip tours</h3><p class='fs-4 ms-3'>Landa Trip provides an opportunity to exchange ideas by placing students in peer groups. You can share your ideas and suggestions with other students and expand your knowledge and experience.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Exposure to Different Cultures with Educational travel</h3><p class='fs-4 ms-3'>Learning while traveling is an incredible way to gain a deeper understanding of the world we live in. One of the most impactful aspects of educational traveling is the opportunity to learn from the people we meet.</p></li></ul><h2>Creating Lifelong Memories with educational journey</h2><p class='fs-4 ms-4'>What makes Landa Trip stand out from other platforms is its emphasis on creating lifelong memories. The educational trips organized by Landa Trip are not limited to expanding knowledge and experience. They can be about your personal growth, cultural information, and setting meaningful connections.</p><ul><li><h3 class='text-xl font-bold mt-10  mb-5'>Share your great moments with friends</h3><p class='fs-4 ms-3'>By participating in our amazing educational tours, you will have wonderful and informative moments with your friends, and you can share your joyful moments in the form of photos or videos on social media or your profile page. You can also follow the pleasant memories of your friends.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Hassle-free travel and course with Landa Trip</h3><p class='fs-4 ms-3'>When you participate in our courses, Landa Trip undertakes all the responsibilities related to planning and organizing your educational tours.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Intensive and specialized training in educational trips</h3><p class='fs-4 ms-3'>In our educational trips, we offer intensive and specialized training for you to gain experience and knowledge in a specific field. During our learning trip, you will have access to abundant educational resources, and all conditions are provided for you to learn as well as possible.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Landa Trip | A productive and intelligent educational environment</h3><p class='fs-4 ms-3'>Landa Trip provides a productive and intelligent educational environment where students can participate actively and develop practical skills.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Spend time with like-minded people in Landa Trip</h3><p class='fs-4 ms-3'>The more carefully you complete your profile, the better an artificial intelligence can add you to the peer group. Click here to sign up and complete your profile.</p></li><li><h3 class='text-xl font-bold mt-10  mb-5'>Having fun and education together</h3><p class='fs-4 ms-3'>Landa Trip is a practical platform that is trying to provide learning journeys for travel lovers to experience fun and education together. With Landa Trip's entertaining tours, you will never feel exhausted during the learning courses, and you will have fun with other companions.</p></li></ul>",
                        "description"  => "Educational traveling refers to the practice of traveling to different places with the purpose of gaining knowledge and having fun and expanding your connections with peer companions. Educational traveling has many benefits for both students and teachers. Education in traveling provides an opportunity to learn deeply and practical during your journey. Every aspect of travel teaches students new soft and hard skills, which they are unlikely to gain in usual situations. Also, educational travel offers students appropriate opportunities to gain valuable insights about the world. Here, we list some of the valuable advantages of education while traveling.",
                        "short_text"   => "Educational traveling refers to the practice of traveling to different places with the purpose of gaining knowledge and having fun and expanding your connections with peer companions. Educational traveling has many benefits for both students and teachers. Education in traveling provides an opportunity to learn deeply and practical during your journey. Every aspect of travel teaches students new soft and hard skills, which they are unlikely to gain in usual situations. Also, educational travel offers students appropriate opportunities to gain valuable insights about the world. Here, we list some of the valuable advantages of education while traveling.",
                        "reading_time" => "8",
                        "keywords"     => " Travel for education, Education through travel, Learning while traveling, Educational travel, Learning journeys, Educational excursions, Educational adventures",
                        "header_pic"      => [
                            'url'        => "ielts-preparation-course.webp",
                            'image_type' => "header",
                            'alt'        => "",
                        ],
                        "thumbnail_image" => [
                            'url'        => "rectangle-2822.webp",
                            'image_type' => "thumbnail",
                            'alt'        => "",
                        ],
                    ],
                ]
            ],
            [
                "title"       => "Digital Marketing",
                "fontawesome" => "fa-display-chart-up-circle-dollar",
                "language_id" => 1,
                "articles"    => []
            ],
            [
                "title"       => "Language Courses",
                "fontawesome" => "fa-language",
                "language_id" => 1,
                "articles"    => []
            ],
            [
                "title"       => "Business Analysis",
                "fontawesome" => "fa-magnifying-glass-chart",
                "language_id" => 1,
                "articles"    => []
            ],
            [
                "title"       => "Management",
                "fontawesome" => "fa-users-gear",
                "language_id" => 1,
                "articles"    => []
            ],
            [
                "title"       => "Creator",
                "fontawesome" => "fa-lightbulb-gear",
                "language_id" => 1,
                "articles"    => []
            ],


            // Persian

            // French

        ];

        foreach ($items as $item) {
            $articleCategoryObj = new ArticleCategory($item);
            $languageObj = Language::find($item["language_id"]);
            unset($articleCategoryObj["articles"]);
            $articleCategoryObj->saveQuietly();

            $userObj = User::where("fname", "=", "iman")->first();
            foreach ($item["articles"] as $value) {
                $articleObj = new Article($value);
                unset($articleObj["header_pic"], $articleObj["thumbnail_image"]);
                $articleObj->user()->associate($userObj);
                $articleObj->articleCategory()->associate($articleCategoryObj);
                $articleObj->withoutEvents(function () use ($articleObj, $languageObj) {
                    $articleObj->slug = $articleObj::makeSlug($articleObj->title);
                    $articleObj->language()->associate($languageObj);
                    $articleObj->save();
                });;


                $imageObj = new Image($value['thumbnail_image']);
                $articleObj->images()->save($imageObj);

                $imageObj = new Image($value['header_pic']);
                $articleObj->images()->save($imageObj);
            }
        }
    }
}
