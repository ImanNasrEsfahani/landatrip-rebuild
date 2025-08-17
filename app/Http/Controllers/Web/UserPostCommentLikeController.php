<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreUserPostCommentLikeRequest;
use App\Models\User;
use App\Models\UserPost;
use App\Models\UserPostComment;
use App\Models\UserPostCommentLike;

class UserPostCommentLikeController extends Controller
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
     * @param  \App\Http\Requests\Api\Web\StoreUserPostCommentLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPostCommentLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPostCommentLike  $userPostCommentLike
     * @return \Illuminate\Http\Response
     */
    public function show(UserPostCommentLike $userPostCommentLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPostCommentLike  $userPostCommentLike
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPostCommentLike $userPostCommentLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateUserPostCommentLikeRequest  $request
     * @param  \App\Models\UserPostCommentLike  $userPostCommentLike
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\Api\Web\UpdateUserPostCommentLikeRequest $request, UserPostCommentLike $userPostCommentLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPostCommentLike  $userPostCommentLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPostCommentLike $userPostCommentLike)
    {
        //
    }



    public function like(User $user, UserPost $userPost, UserPostComment $userPostComment)
    {
        $userPostCommentLikeObj = new UserPostCommentLike();
        $userPostCommentLikeObj->user()->associate(auth()->user());
        $userPostComment->userPostCommentLikes()->save($userPostCommentLikeObj);
        return redirect()->back();
    }

    public function dislike(User $user, UserPost $userPost, UserPostComment $userPostComment, UserPostCommentLike $userPostCommentLike)
    {
        $userPostCommentLike->delete();
        return redirect()->back();
    }
}
