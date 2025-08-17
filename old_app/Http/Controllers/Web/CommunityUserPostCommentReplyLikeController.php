<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\UpdateCommunityUserPostCommentReplyLikeRequest;
use App\Models\Community;
use App\Models\CommunityUserPost;
use App\Models\CommunityUserPostComment;
use App\Models\CommunityUserPostCommentReply;
use App\Models\CommunityUserPostCommentReplyLike;

class CommunityUserPostCommentReplyLikeController extends Controller
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
     * @param  \App\Http\Requests\Api\Web\StoreCommunityUserPostCommentReplyLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\Api\Web\StoreCommunityUserPostCommentReplyLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityUserPostCommentReplyLike  $communityUserPostCommentReplyLike
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityUserPostCommentReplyLike $communityUserPostCommentReplyLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityUserPostCommentReplyLike  $communityUserPostCommentReplyLike
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityUserPostCommentReplyLike $communityUserPostCommentReplyLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateCommunityUserPostCommentReplyLikeRequest  $request
     * @param  \App\Models\CommunityUserPostCommentReplyLike  $communityUserPostCommentReplyLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityUserPostCommentReplyLikeRequest $request, CommunityUserPostCommentReplyLike $communityUserPostCommentReplyLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityUserPostCommentReplyLike  $communityUserPostCommentReplyLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityUserPostCommentReplyLike $communityUserPostCommentReplyLike)
    {
        //
    }



    public function like(Community $community, CommunityUserPost $communityUserPost, CommunityUserPostComment $communityUserPostComment, CommunityUserPostCommentReply $communityUserPostCommentReply)
    {
        $communityUserPostCommentReplyLikeObj = new CommunityUserPostCommentReplyLike();
        $communityUserPostCommentReplyLikeObj->user()->associate(auth()->user());
        $communityUserPostCommentReply->communityUserPostCommentReplyLikes()->save($communityUserPostCommentReplyLikeObj);
        return redirect()->back();
    }

    public function dislike(Community $community, CommunityUserPost $communityUserPost, CommunityUserPostComment $communityUserPostComment, CommunityUserPostCommentReply $communityUserPostCommentReply, string $communityUserPostCommentReplyLike)
    {
        $communityUserPostCommentReplyLike = $communityUserPostCommentReply->communityUserPostCommentReplyLikes()->where("id", "=", $communityUserPostCommentReplyLike)->firstOrFail();
        $communityUserPostCommentReplyLike->delete();
        return redirect()->back();
    }
}
