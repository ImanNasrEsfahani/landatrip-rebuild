<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentReply>
 */
class CommentReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $languageObj = Language::factory()->makeOne();
        $commentObj = Comment::factory()->makeOne();
        //$userObj = User::factory()->makeOne();

        return [
            'language_id'   =>  $languageObj->id,
            'comment_id'    =>  $commentObj->id,
            //'user_id'       =>  $userObj->id,
            'reply'         =>  $this->faker->sentence(6)
        ];
    }
}
