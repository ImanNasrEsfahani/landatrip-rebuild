<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPost;
use App\Models\UserPostComment;
use App\Models\UserPostCommentReply;
use App\Models\UserPostCommentReplyLikes;
use Illuminate\Http\Request;

class UserPostCommentReplyLikeController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user,UserPost $post,UserPostComment $comment,UserPostCommentReply $reply)
    {
        $userPostCommentReplyLikeObj = new UserPostCommentReplyLikes();
        $userPostCommentReplyLikeObj -> user()->associate(auth()->user());
        $userPostCommentReplyLikeObj -> UserPostCommentReply()->associate($reply);
        return $userPostCommentReplyLikeObj->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,UserPost $post,UserPostComment $comment,UserPostCommentReply $reply)
    {
        return $reply->userPostCommentReplyLikes()->where("user_id","=",auth()->user()->id)->first()->delete();
    }
}

