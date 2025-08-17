<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreUserPostCommentReplyLikesRequest;
use App\Models\User;
use App\Models\UserPost;
use App\Models\UserPostComment;
use App\Models\UserPostCommentReply;
use App\Models\UserPostCommentReplyLikes;

class UserPostCommentReplyLikesController extends Controller
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
     * @param  \App\Http\Requests\Api\Web\StoreUserPostCommentReplyLikesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPostCommentReplyLikesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPostCommentReplyLikes  $userPostCommentReplyLikes
     * @return \Illuminate\Http\Response
     */
    public function show(UserPostCommentReplyLikes $userPostCommentReplyLikes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPostCommentReplyLikes  $userPostCommentReplyLikes
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPostCommentReplyLikes $userPostCommentReplyLikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateUserPostCommentReplyLikesRequest  $request
     * @param  \App\Models\UserPostCommentReplyLikes  $userPostCommentReplyLikes
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\Api\Web\UpdateUserPostCommentReplyLikesRequest $request, UserPostCommentReplyLikes $userPostCommentReplyLikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPostCommentReplyLikes  $userPostCommentReplyLikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPostCommentReplyLikes $userPostCommentReplyLikes)
    {
        //
    }




    public function like(User $user, UserPost $userPost, UserPostComment $userPostComment, UserPostCommentReply $userPostCommentReply)
    {
        $userPostCommentReplyLikeObj = new UserPostCommentReplyLikes();
        $userPostCommentReplyLikeObj->user()->associate(auth()->user());
        $userPostCommentReply->userPostCommentReplyLikes()->save($userPostCommentReplyLikeObj);
        return redirect()->back();
    }

    public function dislike(User $user, UserPost $userPost, UserPostComment $userPostComment, UserPostCommentReply $userPostCommentReply, UserPostCommentReplyLikes $userPostCommentReplyLike)
    {
        $userPostCommentReplyLike->delete();
        return redirect()->back();
    }
}
