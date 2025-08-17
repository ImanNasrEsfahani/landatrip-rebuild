<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserPostCommentReply;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class UserPostCommentReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //'user_id'
            //'user_post_comment_id'
            'reply'                     =>  $this->faker->sentence
        ];
    }
}
