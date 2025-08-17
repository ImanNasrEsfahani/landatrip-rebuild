<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\UpdateCommunityUserPostCommentReplyRequest;
use App\Models\CommunityUserPostCommentReply;

class CommunityUserPostCommentReplyController extends Controller
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
     * @param  \App\Http\Requests\Api\Web\StoreCommunityUserPostCommentReplyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\Api\Web\StoreCommunityUserPostCommentReplyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityUserPostCommentReply  $communityUserPostCommentReply
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityUserPostCommentReply $communityUserPostCommentReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityUserPostCommentReply  $communityUserPostCommentReply
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityUserPostCommentReply $communityUserPostCommentReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateCommunityUserPostCommentReplyRequest  $request
     * @param  \App\Models\CommunityUserPostCommentReply  $communityUserPostCommentReply
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityUserPostCommentReplyRequest $request, CommunityUserPostCommentReply $communityUserPostCommentReply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityUserPostCommentReply  $communityUserPostCommentReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityUserPostCommentReply $communityUserPostCommentReply)
    {
        //
    }
}
