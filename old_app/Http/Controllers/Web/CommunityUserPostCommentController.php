<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreCommunityUserPostCommentRequest;
use App\Http\Requests\Api\Web\UpdateCommunityUserPostCommentRequest;
use App\Models\Community;
use App\Models\CommunityUserPost;
use App\Models\CommunityUserPostComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CommunityUserPostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Community $community
     * @param CommunityUserPost $communityUserPost
     * @param \App\Http\Requests\Api\Web\\App\Http\Requests\Api\Web\Web\\App\Http\Requests\Api\Web\StoreCommunityUserPostCommentRequest $request
     * @return RedirectResponse
     */
    public function store(Community $community, CommunityUserPost $communityUserPost, \App\Http\Requests\Api\Web\StoreCommunityUserPostCommentRequest $request)
    {
        $communityUserPostComment = new CommunityUserPostComment($request->validated());
        $communityUserPostComment->user()->associate(auth()->user());
        $communityUserPost->communityUserPostComments()->save($communityUserPostComment);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param CommunityUserPostComment $communityUserPostComment
     * @return Response
     */
    public function show(CommunityUserPostComment $communityUserPostComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CommunityUserPostComment $communityUserPostComment
     * @return Response
     */
    public function edit(CommunityUserPostComment $communityUserPostComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommunityUserPostCommentRequest $request
     * @param CommunityUserPostComment $communityUserPostComment
     * @return Response
     */
    public function update(UpdateCommunityUserPostCommentRequest $request, CommunityUserPostComment $communityUserPostComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommunityUserPostComment $communityUserPostComment
     * @return Response
     */
    public function destroy(CommunityUserPostComment $communityUserPostComment)
    {
        //
    }
}
