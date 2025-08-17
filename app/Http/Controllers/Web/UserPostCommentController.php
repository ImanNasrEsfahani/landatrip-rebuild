<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreUserPostCommentRequest;
use App\Models\User;
use App\Models\UserPost;
use App\Models\UserPostComment;
use Illuminate\Http\RedirectResponse;

class UserPostCommentController extends Controller
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
     * @param User $user
     * @param UserPost $userPost
     * @param \App\Http\Requests\Api\Web\StoreUserPostCommentRequest $request
     * @return RedirectResponse
     */
    public function store(User $user, UserPost $userPost, StoreUserPostCommentRequest $request)
    {
        $userpostComment = new UserPostComment($request->validated());
        $userpostComment->user()->associate(auth()->user());
        $userPost->userPostComments()->save($userpostComment);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPostComment  $userPostComment
     * @return \Illuminate\Http\Response
     */
    public function show(UserPostComment $userPostComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPostComment  $userPostComment
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPostComment $userPostComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateUserPostCommentRequest  $request
     * @param  \App\Models\UserPostComment  $userPostComment
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\Api\Web\UpdateUserPostCommentRequest $request, UserPostComment $userPostComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPostComment  $userPostComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPostComment $userPostComment)
    {
        //
    }
}
