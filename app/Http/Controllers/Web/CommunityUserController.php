<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreCommunityUserRequest;
use App\Http\Requests\Api\Web\UpdateCommunityUserRequest;
use App\Models\CommunityUser;

class CommunityUserController extends Controller
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
     * @param \App\Http\Requests\Api\Web\StoreCommunityUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\Api\Web\StoreCommunityUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityUser  $communityUser
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityUser $communityUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityUser  $communityUser
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityUser $communityUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateCommunityUserRequest  $request
     * @param  \App\Models\CommunityUser  $communityUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityUserRequest $request, CommunityUser $communityUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityUser  $communityUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityUser $communityUser)
    {
        //
    }
}
