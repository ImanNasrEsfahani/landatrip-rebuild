<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupPostRequest;
use App\Http\Requests\UpdateGroupPostRequest;
use App\Models\Group;
use App\Models\GroupPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class GroupPostController extends Controller
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
     * @param StoreGroupPostRequest $request
     * @return RedirectResponse
     */
    public function store(Group $group, StoreGroupPostRequest $request)
    {
        $groupPost = new GroupPost($request->validated());
        $groupPost->user()->associate(auth()->user());
        $group->groupPosts()->save($groupPost);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupPost  $groupPost
     * @return Response
     */
    public function show(GroupPost $groupPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupPost  $groupPost
     * @return Response
     */
    public function edit(GroupPost $groupPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupPostRequest  $request
     * @param  \App\Models\GroupPost  $groupPost
     * @return Response
     */
    public function update(UpdateGroupPostRequest $request, GroupPost $groupPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupPost  $groupPost
     * @return Response
     */
    public function destroy(GroupPost $groupPost)
    {
        //
    }
}
