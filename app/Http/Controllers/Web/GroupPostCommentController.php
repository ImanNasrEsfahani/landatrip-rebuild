<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupPostCommentRequest;
use App\Http\Requests\UpdateGroupPostCommentRequest;
use App\Models\GroupPostComment;

class GroupPostCommentController extends Controller
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
     * @param  \App\Http\Requests\StoreGroupPostCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupPostCommentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupPostComment  $groupPostComment
     * @return \Illuminate\Http\Response
     */
    public function show(GroupPostComment $groupPostComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupPostComment  $groupPostComment
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupPostComment $groupPostComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupPostCommentRequest  $request
     * @param  \App\Models\GroupPostComment  $groupPostComment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupPostCommentRequest $request, GroupPostComment $groupPostComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupPostComment  $groupPostComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupPostComment $groupPostComment)
    {
        //
    }
}
