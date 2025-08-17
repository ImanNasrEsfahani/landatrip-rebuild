<?php

namespace App\Http\Controllers\Application\v1\ClientApp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Application\v1\ClientApp\StoreCommentPost;
use App\Http\Requests\Api\Application\v1\ClientApp\StoreReplyComment;
use App\Models\UserPost;
use App\Models\UserPostComment;
use App\Models\UserPostCommentReply;
use Illuminate\Http\Request;

class ReplyCommentPost extends Controller
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
    public function store(UserPostComment $comment, StoreReplyComment $request)
    {
        $CommentRecord = new UserPostCommentReply($request->validated());
        $CommentRecord->UserPostComment()->associate($comment);
        $CommentRecord->user()->associate(auth()->user());
        return $CommentRecord->save();
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
    public function destroy($id)
    {
        //
    }
}
