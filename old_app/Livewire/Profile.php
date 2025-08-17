<?php

namespace App\Livewire;

use App\Enums\GroupStatusEnum;
use App\Enums\GroupUserStatusEnum;
use App\Models\City;
use App\Models\Following;
use App\Models\Group;
use App\Models\Image;
use App\Models\User;
use App\Models\UserPost;
use Carbon\Carbon;
use Http\Client\Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

//    #[Validate(['photos.*' => 'image|max:1024'])]
    public $media = [];

    public $title = '';

    public $group_id = '';

    public User       $user;
    public ?bool      $isFollowed;
    public ?bool      $isFollowing;
    public Collection $groups;
    public Collection $communities;
    public            $traveledUser;

    public string $location      = '';
    public array  $searchResults = [];


    public function mount(User $user)
    {
        $this->user = $user;
        $this->isFollowed = auth()->user() ? Following::where("follower_id", "=", $this->user->id)->where("followed_id", "=", auth()->user()->id)->count() : - 1;
        $this->isFollowing = auth()->user() ? Following::where("follower_id", "=", auth()->user()->id)->where("followed_id", "=", $this->user->id)->count() : - 1;
        $this->groups = Group::where('status', '=', GroupStatusEnum::registration)->where('language_id', "=", 1)->get();
        $allUsers = collect([]);
        foreach ($user->groups()->get() as $group) {
            foreach ($group->users()->get() as $user) {
                $allUsers->push($user);
            }
        }
        $this->traveledUser = $allUsers->unique('id')->values();
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
            } else {
                $this->dispatch('login');
            }
        } catch (Exception) {
            session()->flush('error', "You Can't follow right now please try again later");
        }
    }

    public function deleteImage($imageId): void
    {
        if ($this->media[$imageId]) {
            unset($this->media[$imageId]);
        }
    }

    public function save_post($is_draft = false): void
    {
        try {
            if (auth()->user()) {
                if ($this->media) {
                    $postObj = new UserPost();
                    $postObj->title = $this->title;
                    $postObj->user()->associate(auth()->user());
                    $postObj->group()->associate(auth()->user()->groups()->where('group_id', $this->group_id)->first());
                    $postObj->location = $this->location;
                    $postObj->is_drafted = $is_draft;
                    $postObj->is_approved = true;
                    $postObj->save();
                    foreach ($this->media as $media) {
                        $fileType = $media->getMimeType();
                        $fileName = strtolower(Carbon::now()->format('Ymd') . "_" . trim($media->getClientOriginalName()));
                        $media->storeAs('posts', $fileName, 'public');
                        $postObj->images()->create([
                            "url"        => $fileName,
                            "image_type" => 'content',
                            "file_type"  => $fileType,
                            "alt"        => auth()->user()->name
                        ]);
                    }
                    $this->reset(['media', 'title', 'location', 'group_id']);
                }
            } else {
                $this->dispatch('login');
            }
        } catch (Exception) {
            session()->flush('error', "You Can't follow right now please try again later");
        }
//        dd($this->photos, $this->title);
//
    }


    public function updatedlocation(): void
    {
        if ($this->location != '') {
            $this->searchResults = City::where('name', 'like', '%' . $this->location . '%')->pluck('name')->all();
        } else {
            $this->searchResults = [];
        }
    }

    public function login()
    {

        dd($this->title, $this->media, $this->location, $this->group_id);

//        $this->dispatch('login', ['hi amin']);
//        print_r("login");
    }

    public function discard(): void
    {
        $this->reset(['title', 'media', 'location', 'group_id']);
    }

    public function deleteDraft(UserPost $post): void
    {
        foreach ($post->images as $media){
            dd($media);
        }
        Storage::delete("posts/".$post->images());
        $post->delete();
    }

    public function setDraft(UserPost $post)
    {
        $this->title = $post->title;
        $this->location = $post->location;
        $this->group_id = $post->group->id;

        $this->dispatch('draftpopup', false);
    }


    public function render()
    {
        return view('livewire.profile.profile')->extends('layout.layout-profile')->section('content');
    }
}
