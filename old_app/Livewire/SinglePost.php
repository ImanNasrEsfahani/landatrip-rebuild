<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserPost;
use App\Models\UserPostComment;
use App\Models\UserPostCommentLike;
use App\Models\UserPostCommentReply;
use App\Models\UserPostCommentReplyLikes;
use App\Models\UserPostLike;
use App\Models\UserPostSave;
use Http\Client\Exception;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SinglePost extends Component
{
    public UserPost $post;
    public User     $user;
    public int      $isLiked;
    public int      $isSaved;

    #[Validate('required|min:3')]
    public string   $comment = '';

    public function mount(UserPost $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
        $this->isLiked = auth()->user() ? $post->userPostLikes()->where("user_id", "=", auth()->user()->id)->count() : 0;
        $this->isSaved = auth()->user() ? $post->usersPostSaved()->where("user_id", "=", auth()->user()->id)->count() : 0;

    }

    public function like()
    {
        try {
            if (auth()->user()) {
                if ($this->post->userPostLikes()->where("user_id", "=", auth()->user()->id)->count()) {
                    return $this->post->userPostLikes()->where("user_id", "=", auth()->user()->id)->first()->delete();
                } else {
                    $userPostLikeObj = new UserPostLike();
                    $userPostLikeObj->user()->associate(auth()->user());
                    $userPostLikeObj->userPost()->associate($this->post);
                    return $userPostLikeObj->save();
                }
            }
            $this->dispatch('login');
        } catch (Exception) {
            session()->flush('error', "You Can't follow right now please try again later");
        }
    }

    public function savePost()
    {
        try {
            if (auth()->user()) {
                if ($this->post->usersPostSaved()->where("user_id", "=", auth()->user()->id)->count()) {
                    return $this->post->usersPostSaved()->where("user_id", "=", auth()->user()->id)->first()->delete();
                } else {
                    $postMassageSave = new UserPostSave();
                    $postMassageSave->user()->associate(auth()->user());
                    $postMassageSave->userPost()->associate($this->post);
                    return $postMassageSave->save();
                }
            }
            $this->dispatch('login');
        } catch (Exception) {
            session()->flush('error', "You Can't follow right now please try again later");
        }
    }

    public function likeComment(UserPostComment $comment)
    {
        try {
            if (auth()->user()) {
                if ($comment->userPostCommentLikes()->where("user_id", "=", auth()->user()->id)->count()) {
                    return $comment->userPostCommentLikes()->where("user_id", "=", auth()->user()->id)->first()->delete();
                } else {
                    $commentLikeObj = new UserPostCommentLike();
                    $commentLikeObj->user()->associate(auth()->user());
                    $commentLikeObj->userPostComment()->associate($comment);
                    return $commentLikeObj->save();
                }
            }
            $this->dispatch('login');
        } catch (Exception) {
            session()->flush('error', "You Can't follow right now please try again later");
        }
    }

    public function likeCommentReply(UserPostCommentReply $reply)
    {
        try {
            if (auth()->user()) {
                if ($reply->userPostCommentReplyLikes()->where("user_id", "=", auth()->user()->id)->count()) {
                    return $reply->userPostCommentReplyLikes()->where("user_id", "=", auth()->user()->id)->first()->delete();
                } else {
                    $commentReplyObj = new UserPostCommentReplyLikes();
                    $commentReplyObj->user()->associate(auth()->user());
                    $commentReplyObj->userPostCommentReply()->associate($reply);
                    return $commentReplyObj->save();
                }
            }
            $this->dispatch('login');
        } catch (Exception) {
            session()->flush('error', "You Can't follow right now please try again later");
        }
    }

    public function saveComment($id = null){
        if (auth()->user()){
            if ($id){
                $this->validate();
                $userPostComment= $this->post->userPostComments()->where('id', '=', $id)->first();
                $commentReplyObj= new UserPostCommentReply();
                $commentReplyObj->reply = $this->comment;
                $commentReplyObj->userPostComment()->associate($userPostComment);
                $commentReplyObj->user()->associate(auth()->user());
                $commentReplyObj->save();
                $this->reset('comment');
                $this->dispatch('close_reply');
            }else{
                $this->validate();
                $commentObj = new UserPostComment();
                $commentObj->comment = $this->comment;
                $commentObj->userPost()->associate($this->post);
                $commentObj->user()->associate(auth()->user());
                $commentObj->save();
                $this->reset('comment');
            }
        }else{
            $this->dispatch('login');
        }
    }

    public function render()
    {
        return view('livewire.single-post.single-post');
    }
}
