<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\UpdateCommunityUserPostLikeRequest;
use App\Models\Community;
use App\Models\CommunityUserPost;
use App\Models\CommunityUserPostLike;

class CommunityUserPostLikeController extends Controller
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
     * @param  \App\Http\Requests\Api\Web\StoreCommunityUserPostLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\Api\Web\StoreCommunityUserPostLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityUserPostLike  $communityUserPostLike
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityUserPostLike $communityUserPostLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityUserPostLike  $communityUserPostLike
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityUserPostLike $communityUserPostLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateCommunityUserPostLikeRequest  $request
     * @param  \App\Models\CommunityUserPostLike  $communityUserPostLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityUserPostLikeRequest $request, CommunityUserPostLike $communityUserPostLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityUserPostLike  $communityUserPostLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityUserPostLike $communityUserPostLike)
    {
        //
    }



    public function like(Community $community, CommunityUserPost $communityUserPost)
    {
        $communityUserPostLikeObj = new CommunityUserPostLike();
        $communityUserPostLikeObj->user()->associate(auth()->user());
        $communityUserPost->communityUserPostLikes()->save($communityUserPostLikeObj);
        return redirect()->back();
    }

    public function dislike(Community $community, CommunityUserPost $communityUserPost, CommunityUserPostLike $communityUserPostLike)
    {
        $communityUserPostLike->delete();
        return redirect()->back();
    }
}
