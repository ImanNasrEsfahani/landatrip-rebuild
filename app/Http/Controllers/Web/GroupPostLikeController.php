<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupPostLikeRequest;
use App\Http\Requests\UpdateGroupPostLikeRequest;
use App\Models\GroupPostLike;

class GroupPostLikeController extends Controller
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
     * @param  \App\Http\Requests\StoreGroupPostLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupPostLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupPostLike  $groupPostLike
     * @return \Illuminate\Http\Response
     */
    public function show(GroupPostLike $groupPostLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupPostLike  $groupPostLike
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupPostLike $groupPostLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupPostLikeRequest  $request
     * @param  \App\Models\GroupPostLike  $groupPostLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupPostLikeRequest $request, GroupPostLike $groupPostLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupPostLike  $groupPostLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupPostLike $groupPostLike)
    {
        //
    }
}
