<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreUserPostCommentReplyRequest;
use App\Models\UserPostCommentReply;

class UserPostCommentReplyController extends Controller
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
     * @param  \App\Http\Requests\Api\Web\StoreUserPostCommentReplyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPostCommentReplyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPostCommentReply  $userPostCommentReply
     * @return \Illuminate\Http\Response
     */
    public function show(UserPostCommentReply $userPostCommentReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPostCommentReply  $userPostCommentReply
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPostCommentReply $userPostCommentReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateUserPostCommentReplyRequest  $request
     * @param  \App\Models\UserPostCommentReply  $userPostCommentReply
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\Api\Web\UpdateUserPostCommentReplyRequest $request, UserPostCommentReply $userPostCommentReply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPostCommentReply  $userPostCommentReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPostCommentReply $userPostCommentReply)
    {
        //
    }
}
