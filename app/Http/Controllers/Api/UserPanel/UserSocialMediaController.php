<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\StoreUserEducationRequest;
use App\Http\Requests\Api\UserPanel\StoreUserSocialMediaRequest;
use App\Http\Requests\Api\UserPanel\UpdateUserSocialMediaRequest;
use App\Http\Resources\User\UserSocialMediaResource;
use App\Models\SocialMedia;
use App\Models\User;
use App\Models\userSocialMedia;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Throwable;

class UserSocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
//        dd(auth()->user()->socialMedia()->get());
        return UserSocialMediaResource::collection(auth()->user()->socialMedia()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return bool
     */
    public function store(StoreUserSocialMediaRequest $validation,SocialMedia $socialMedia)
    {
        $UserSocialMedia = New UserSocialMedia($validation->validated());
        $UserSocialMedia->user()->associate(auth()->user());
        return $UserSocialMedia->save();
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\UserPanel\UpdateUserSocialMediaRequest $request
     * @param User $user
     * @return mixed
     */
    public function update(\App\Http\Requests\Api\UserPanel\UpdateUserSocialMediaRequest $validation): mixed
    {
        $UserSocialMedia = New UserSocialMedia($validation->validated());
        $UserSocialMedia->user()->associate(auth()->user());
        return $UserSocialMedia->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SocialMedia $socialMedia
     * @return Response
     * @throws Throwable
     */
    public function destroy(SocialMedia $social_medium)
    {
        $userSocialMedia = UserSocialMedia::where("user_id", "=", auth()->user()->id)->where("social_media_id", "=", $social_medium->id)->first();
        if($userSocialMedia) {
            return $userSocialMedia->deleteOrFail();
        }
        return \response()->json(["data", "This record is not available"], 404);
    }
}
