<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupUserPostRequest;
use App\Http\Requests\UpdateGroupUserPostRequest;
use App\Models\GroupUserPost;

class GroupUserPostController extends Controller
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
     * @param  \App\Http\Requests\StoreGroupUserPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupUserPostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupUserPost  $groupUserPost
     * @return \Illuminate\Http\Response
     */
    public function show(GroupUserPost $groupUserPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupUserPost  $groupUserPost
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupUserPost $groupUserPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupUserPostRequest  $request
     * @param  \App\Models\GroupUserPost  $groupUserPost
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupUserPostRequest $request, GroupUserPost $groupUserPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupUserPost  $groupUserPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupUserPost $groupUserPost)
    {
        //
    }
}
