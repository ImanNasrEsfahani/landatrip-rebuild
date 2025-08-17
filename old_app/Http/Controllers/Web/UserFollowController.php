<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\UpdateUserFollowRequest;
use App\Http\Requests\StoreUserFollowRequest;
use App\Models\UserFollow;

class UserFollowController extends Controller
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
     * @param  \App\Http\Requests\StoreUserFollowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserFollowRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserFollow  $userFollow
     * @return \Illuminate\Http\Response
     */
    public function show(UserFollow $userFollow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserFollow  $userFollow
     * @return \Illuminate\Http\Response
     */
    public function edit(UserFollow $userFollow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Web\UpdateUserFollowRequest  $request
     * @param  \App\Models\UserFollow  $userFollow
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserFollowRequest $request, UserFollow $userFollow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserFollow  $userFollow
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserFollow $userFollow)
    {
        //
    }
}
