<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreUserPostLikeRequest;
use App\Models\User;
use App\Models\UserPost;
use App\Models\UserPostLike;

class UserPostLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\StoreUserPostLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPostLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPostLike  $userPostLike
     * @return \Illuminate\Http\Response
     */
    public function show(UserPostLike $userPostLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPostLike  $userPostLike
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPostLike $userPostLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateUserPostLikeRequest  $request
     * @param  \App\Models\UserPostLike  $userPostLike
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\Api\Web\UpdateUserPostLikeRequest $request, UserPostLike $userPostLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPostLike  $userPostLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPostLike $userPostLike)
    {
        //
    }


    public function like(User $user, UserPost $userPost)
    {
        $userPostLikeObj = new UserPostLike();
        $userPostLikeObj->user()->associate(auth()->user());
        $userPost->userPostLikes()->save($userPostLikeObj);
        return redirect()->back();
    }

    public function dislike(User $user, UserPost $userPost, UserPostLike $userPostLike)
    {
        $userPostLike->delete();
        return redirect()->back();
    }
}
