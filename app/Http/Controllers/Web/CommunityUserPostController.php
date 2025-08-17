<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreCommunityUserPostRequest;
use App\Http\Requests\Api\Web\UpdateCommunityUserPostRequest;
use App\Models\Community;
use App\Models\CommunityUserPost;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CommunityUserPostController extends Controller
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
     * @param \App\Http\Requests\Api\Web\\App\Http\Requests\Api\Web\Web\StoreCommunityUserPostRequest $request
     * @return RedirectResponse|Response
     */
    public function store(Community $community, \App\Http\Requests\Api\Web\StoreCommunityUserPostRequest $request)
    {
        $followed = auth()->user()->communities()->where('community_id', '=', $community->id)->first();
        if(!$followed) return redirect()->back()->with(["follow" => "You should follow in first."]);
        $communityUserPostObj = new CommunityUserPost($request->validated());
        $communityUserPostObj->user()->associate(auth()->user());
        $community->communityUserPosts()->save($communityUserPostObj);

        $imageName = time() . '.' . $request->validated("image")->extension();
        $request->image->storeAs('/public/communities/posts', $imageName);
        $imageObj = new Image([
            "url"           =>  $imageName,
            "image_type"    =>  "content",
            "alt"           =>  auth()->user()->location . " " . auth()->user()->fname . " " . auth()->user()->lname
        ]);
        $communityUserPostObj->images()->save($imageObj);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param CommunityUserPost $communityUserPost
     * @return Response
     */
    public function show(CommunityUserPost $communityUserPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CommunityUserPost $communityUserPost
     * @return Response
     */
    public function edit(CommunityUserPost $communityUserPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\Web\UpdateCommunityUserPostRequest $request
     * @param CommunityUserPost $communityUserPost
     * @return Response
     */
    public function update(UpdateCommunityUserPostRequest $request, CommunityUserPost $communityUserPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommunityUserPost $communityUserPost
     * @return Response
     */
    public function destroy(CommunityUserPost $communityUserPost)
    {
        //
    }
}
