<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\CommunityUserPost;
use App\Models\CommunityUserPostComment;
use App\Models\CommunityUserPostCommentLike;
use App\Models\CommunityUserPostCommentReply;
use App\Models\CommunityUserPostCommentReplyLike;
use App\Models\CommunityUserPostLike;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
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
                'header_pic'        =>  [
                                            'url'           =>      'header-image.png',
                                            'image_type'    =>      'header',
                                            'alt'           =>      'travel lovers - Landa Trip'
                                        ],
                'thumbnail_pic'     =>  [
                                            'url'           =>      'travel-lovers.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'travel lovers - Landa Trip'
                                        ],
                "user_id"           =>  1,
                "title"             =>  "Travel Lovers",
                "slug"              =>  "travel-lovers",
                "about_us"          =>  "We love to travelling always!",
                "admin_only"        =>  false,
                "posts"             =>  [
                                            [
                                                "location"      =>  'Dubai UAE',
                                                "title"         =>  'New tendency in travel: Blend Business and Leisure Travel',
                                                "image"         =>  [
                                                    'url'           =>  "content-01.png",
                                                    'image_type'    =>  "content",
                                                    'alt'           =>  "leisure travel by landa trip",
                                                ],
                                                "comments"          =>  [
                                                    [
                                                        //'community_post_id',
                                                        'user_id'               =>  User::inRandomOrder()->first()->id,
                                                        'comment'               =>  'Wow, how amazing! That’s fantastic.',
                                                        'replies'               =>  []
                                                    ],
                                                    [
                                                        //'community_post_id',
                                                        'user_id'               =>  User::inRandomOrder()->first()->id,
                                                        'comment'               =>  'It has a good color palette.',
                                                        'replies'               =>  [
                                                                                        [
                                                                                            //'community_post_comment_id'     =>  '',
                                                                                            'user_id'                       =>  User::inRandomOrder()->first()->id,
                                                                                            'reply'                         =>  'Thanks. It\'s a diagonal color selection on the color wheel'
                                                                                        ]
                                                                                ]
                                                    ]
                                                ]
                                            ],
                                            [
                                                "location"      =>  'Istanbul Turkey',
                                                "title"         =>  'Blend Business and Leisure Travel',
                                                "image"         =>  [
                                                    'url'           =>  "content-02.png",
                                                    'image_type'    =>  "content",
                                                    'alt'           =>  "travel by landa trip",
                                                ],
                                                "comments"          =>  [
                                                    [
                                                        //'community_post_id',
                                                        'user_id'               =>  User::inRandomOrder()->first()->id,
                                                        'comment'               =>  'That’s fantastic.',
                                                        'replies'               =>  []
                                                    ],
                                                    [
                                                        //'community_post_id',
                                                        'user_id'               =>  User::inRandomOrder()->first()->id,
                                                        'comment'               =>  'Wow, how amazing!',
                                                        'replies'               =>  [
                                                                                        [
                                                                                            //'community_post_comment_id'     =>  '',
                                                                                            'user_id'                       =>  User::inRandomOrder()->first()->id,
                                                                                            'reply'                         =>  'Thanks.'
                                                                                        ]
                                                                                ]
                                                    ]
                                                ]
                                            ]
                                        ]
            ],
            [
                'header_pic'        =>  [
                                            'url'           =>      'header-image.png',
                                            'image_type'    =>      'header',
                                            'alt'           =>      'photo shooting in travel - Landa Trip'
                                        ],
                'thumbnail_pic'     =>  [
                                            'url'           =>      'photo-shooting-in-travel.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'photo shooting in travel - Landa Trip'
                                        ],
                "user_id"           =>  1,
                "title"             =>  "Photo Shooting in Travel",
                "slug"              =>  "photo-shooting-in-travel",
                "about_us"          =>  "The photos remain from the travels",
                "admin_only"        =>  false,
                "posts"             =>  [
                                            [
                                                "location"      =>  'Dubai UAE',
                                                "title"         =>  'New tendency in travel: Blend Business and Leisure Travel',
                                                "image"         =>  [
                                                    'url'           =>  "content-01.png",
                                                    'image_type'    =>  "content",
                                                    'alt'           =>  "leisure travel by landa trip",
                                                ],
                                                "comments"          =>  []
                                            ]
                                        ]
            ],
            [
                'header_pic'        =>  [
                                            'url'           =>      'header-image.png',
                                            'image_type'    =>      'header',
                                            'alt'           =>      'educational travel - Landa Trip'
                                        ],
                'thumbnail_pic'     =>  [
                                            'url'           =>      'educational-travel.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'educational travel - Landa Trip'
                                        ],
                "user_id"           =>  1,
                "title"             =>  "Educational Travel",
                "slug"              =>  "educational-travel",
                "about_us"          =>  "Learn new thing with us in Journey",
                "admin_only"        =>  false,
                "posts"             =>  [
                                            [
                                                "location"      =>  'Dubai UAE',
                                                "title"         =>  'New tendency in travel: Blend Business and Leisure Travel',
                                                "image"         =>  [
                                                    'url'           =>  "content-01.png",
                                                    'image_type'    =>  "content",
                                                    'alt'           =>  "leisure travel by landa trip",
                                                ],
                                                "comments"          =>  []
                                            ]
                                        ]
            ],
            [
                'header_pic'        =>  [
                                            'url'           =>      'header-image.png',
                                            'image_type'    =>      'header',
                                            'alt'           =>      'freelancers - Landa Trip'
                                        ],
                'thumbnail_pic'     =>  [
                                            'url'           =>      'freelancers.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'freelancers - Landa Trip'
                                        ],
                "user_id"           =>  1,
                "title"             =>  "Freelancers",
                "slug"              =>  "freelancers",
                "about_us"          =>  "Freedom is every things",
                "admin_only"        =>  false,
                "posts"             =>  [
                                            [
                                                "location"      =>  'Dubai UAE',
                                                "title"         =>  'New tendency in travel: Blend Business and Leisure Travel',
                                                "image"         =>  [
                                                    'url'           =>  "content-01.png",
                                                    'image_type'    =>  "content",
                                                    'alt'           =>  "leisure travel by landa trip",
                                                ],
                                                "comments"          =>  []
                                            ]
                                        ]
            ],
            [
                'header_pic'        =>  [
                                            'url'           =>      'header-image.png',
                                            'image_type'    =>      'header',
                                            'alt'           =>      ' - Landa Trip'
                                        ],
                'thumbnail_pic'     =>  [
                                            'url'           =>      'web-designers.png',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      'web-designers - Landa Trip'
                                        ],
                "user_id"           =>  1,
                "title"             =>  "Web Designers",
                "slug"              =>  "web-designers",
                "about_us"          =>  "Web Designers from the around",
                "admin_only"        =>  false,
                "posts"             =>  [
                                            [
                                                "location"      =>  'Dubai UAE',
                                                "title"         =>  'New tendency in travel: Blend Business and Leisure Travel',
                                                "image"         =>  [
                                                    'url'           =>  "content-01.png",
                                                    'image_type'    =>  "content",
                                                    'alt'           =>  "leisure travel by landa trip",
                                                ],
                                                "comments"          =>  []
                                            ]
                                        ]
            ],
/*            [
                'header_pic'        =>  [
                                            'url'           =>      'header-image.png',
                                            'image_type'    =>      'header',
                                            'alt'           =>      ' - Landa Trip'
                                        ],
                'thumbnail_pic'     =>  [
                                            'url'           =>      '',
                                            'image_type'    =>      'thumbnail',
                                            'alt'           =>      ' - Landa Trip'
                                        ],
                "user_id"           =>  1,
                "title"             =>  "",
                "slug"              =>  "",
                "about_us"          =>  "",
                "admin_only"        =>  false,
                "posts"             =>  [
                                            [
                                                //'community_id',
                                                'user_id'       =>  User::inRandomOrder()->first()->id,
                                                "location"      =>  'Dubai UAE',
                                                "title"         =>  'New tendency in travel: Blend Business and Leisure Travel',
                                                "image"         =>  [
                                                    'url'           =>  "content-01.png",
                                                    'image_type'    =>  "content",
                                                    'alt'           =>  "leisure travel by landa trip",
                                                ],
                                                "comments"          =>  []
                                            ]
                                        ]
            ],*/
        ];

        foreach ($items as $item) {

            $community = new Community($item);
            unset($community["header_pic"], $community["thumbnail_pic"], $community["posts"]);
            $community->withoutEvents(function () use ($community) {
                $community->id = $community->newUniqueId();
                $community->slug = $community::makeSlug($community->title);
                $community->save();
            });

            $imageObj = new Image($item['header_pic']);
            $community->images()->save($imageObj);

            $imageObj = new Image($item['thumbnail_pic']);
            $community->images()->save($imageObj);

            // Join Users in this community
            $users = User::inRandomOrder()->limit(random_int(8,User::count()))->get();
            foreach ($users as $user) {
                $user->communities()->save($community);
            }

            foreach ($item['posts'] as $post) {
                $image = $post['image'];
                $comments = $post['comments'];
                unset($post["image"], $post["comments"]);

                // Community Posts
                $communityUserPost = new CommunityUserPost($post);
                $communityUserPost->user()->associate($community->users()->inRandomOrder()->first());
                $community->communityUserPosts()->save($communityUserPost);

                $imageObj = new Image($image);
                $communityUserPost->images()->save($imageObj);

                // Community Post Likes
                $someUsersOfCommunity = $community->users()->inRandomOrder()->limit($community->users()->count()/2)->get();
                foreach ($someUsersOfCommunity as $member) {
                    $communityUserPostLike = new CommunityUserPostLike();
                    $communityUserPostLike->user()->associate($member);
                    $communityUserPost->communityUserPostLikes()->save($communityUserPostLike);
                }

                // Comment for this post
                foreach ($comments as $comment) {
                    $replies = $comment["replies"] ?? [];
                    if (!empty($comment)) unset($comment["replies"]);
                    $communityUserPostComment = new CommunityUserPostComment($comment);
                    $communityUserPost->communityUserPostComments()->save($communityUserPostComment);


                    // Comment likes
                    $someUsersOfCommunity = $community->users()->inRandomOrder()->limit($community->users()->count()/4)->get();
                    foreach ($someUsersOfCommunity as $member) {
                        $communityUserPostCommentLike = new CommunityUserPostCommentLike();
                        $communityUserPostCommentLike->user()->associate($member);
                        $communityUserPostComment->communityUserPostCommentLikes()->save($communityUserPostCommentLike);
                    }


                    // reply for this comment of this post
                    foreach ($replies as $reply) {
                        $communityUserPostCommentReply = new CommunityUserPostCommentReply($reply);
                        $communityUserPostComment->communityUserPostCommentReplies()->save($communityUserPostCommentReply);

                        // reply likes
                        $someUsersOfCommunity = $community->users()->inRandomOrder()->limit($community->users()->count()/5)->get();
                        foreach ($someUsersOfCommunity as $member) {
                            $communityUserPostCommentReplyLike = new CommunityUserPostCommentReplyLike();
                            $communityUserPostCommentReplyLike->user()->associate($member);
                            $communityUserPostCommentReply->communityUserPostCommentReplyLikes()->save($communityUserPostCommentReplyLike);
                        }
                    }
                }
                // End Comment
            }
            // End Post
        }
        // End of community
    }
}
