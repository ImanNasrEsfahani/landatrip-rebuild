<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreCommunityUserPostCommentLikeRequest;
use App\Http\Requests\Api\Web\UpdateCommunityUserPostCommentLikeRequest;
use App\Models\Community;
use App\Models\CommunityUserPost;
use App\Models\CommunityUserPostComment;
use App\Models\CommunityUserPostCommentLike;

class CommunityUserPostCommentLikeController extends Controller
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
     * @param  \App\Http\Requests\Api\Web\StoreCommunityUserPostCommentLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Community $community, CommunityUserPost $communityUserPost, CommunityUserPostCommentLike $communityUserPostCommentLike, StoreCommunityUserPostCommentLikeRequest $request)
    {
        dd($community);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityUserPostCommentLike  $communityUserPostCommentLike
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityUserPostCommentLike $communityUserPostCommentLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityUserPostCommentLike  $communityUserPostCommentLike
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityUserPostCommentLike $communityUserPostCommentLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateCommunityUserPostCommentLikeRequest  $request
     * @param  \App\Models\CommunityUserPostCommentLike  $communityUserPostCommentLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityUserPostCommentLikeRequest $request, CommunityUserPostCommentLike $communityUserPostCommentLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityUserPostCommentLike  $communityUserPostCommentLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityUserPostCommentLike $communityUserPostCommentLike)
    {
        //
    }



    public function like(Community $community, CommunityUserPost $communityUserPost, CommunityUserPostComment $communityUserPostComment)
    {
        $communityUserPostCommentLikeObj = new CommunityUserPostCommentLike();
        $communityUserPostCommentLikeObj->user()->associate(auth()->user());
        $communityUserPostComment->communityUserPostCommentLikes()->save($communityUserPostCommentLikeObj);
        return redirect()->back();
    }

    public function dislike(Community $community, CommunityUserPost $communityUserPost, CommunityUserPostComment $communityUserPostComment, CommunityUserPostCommentLike $communityUserPostCommentLike)
    {
        $communityUserPostCommentLike->delete();
        return redirect()->back();
    }
}
