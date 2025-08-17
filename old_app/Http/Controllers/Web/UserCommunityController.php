<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreUserCommunityRequest;
use App\Models\UserCommunity;

class UserCommunityController extends Controller
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
     * @param  \App\Http\Requests\Api\Web\StoreUserCommunityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserCommunityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCommunity  $userCommunity
     * @return \Illuminate\Http\Response
     */
    public function show(UserCommunity $userCommunity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCommunity  $userCommunity
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCommunity $userCommunity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateUserCommunityRequest  $request
     * @param  \App\Models\UserCommunity  $userCommunity
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\Api\Web\UpdateUserCommunityRequest $request, UserCommunity $userCommunity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCommunity  $userCommunity
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCommunity $userCommunity)
    {
        //
    }
}
