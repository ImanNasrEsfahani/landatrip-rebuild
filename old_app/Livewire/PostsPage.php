<?php

namespace App\Livewire;

use App\Models\Following;
use App\Models\User;
use App\Models\UserPost;
use App\Models\UserPostLike;
use Http\Client\Exception;
use Livewire\Component;

class PostsPage extends Component
{
    public User  $user;
    public ?bool $isFollowed;
    public ?bool $isFollowing;


    public function mount(User $user)
    {
        $this->user = $user;
        $this->isFollowed = auth()->user() ? Following::where("follower_id", "=", $this->user->id)->where("followed_id", "=", auth()->user()->id)->count() : 0;
        $this->isFollowing = auth()->user() ? Following::where("follower_id", "=", auth()->user()->id)->where("followed_id", "=", $this->user->id)->count() : 0;
    }

    public function follow()
    {
        try {
            if (auth()->user() && !(auth()->user()->id == $this->user->id)) {
                if ($this->isFollowing) {
                    $followingObj = Following::where("follower_id", "=", auth()->user()->id)->where("followed_id", "=", $this->user->id)->first();
                    if ($followingObj) {
                        $this->isFollowing = false;
                        return $followingObj->delete();
                    }
                    return abort(402, "This object cannot found");
                } else {
                    if (!(Following::where("follower_id", '=', auth()->user()->id)->where("followed_id", '=', $this->user->id)->count() > 0)) {
                        $userFollowingObj = new Following();
                        $userFollowingObj->followerUser()->associate(auth()->user());
                        $userFollowingObj->followedUser()->associate($this->user);
                        $this->isFollowing = true;
                        return $userFollowingObj->save();
                    }
                    return abort(402, "oh noooo");
                }
            }
            $this->dispatch('login');
        } catch (Exception) {
            session()->flush('error', "You Can't follow right now please try again later");
        }
    }

    public function render()
    {
        return view('livewire.posts-page.posts-page', [
            'user'        => $this->user,
            'isFollowed'  => $this->isFollowed,
            'isFollowing' => $this->isFollowing,
        ])->extends('layout.layout-profile')->section('content');
    }
}
