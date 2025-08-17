<?php

namespace App\Http\Controllers;

use App\Models\UserBadgeLevel;
use App\Http\Requests\StoreUserBadgeLevelRequest;
use App\Http\Requests\UpdateUserBadgeLevelRequest;

class UserBadgeLevelController extends Controller
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
     * @param  \App\Http\Requests\StoreUserBadgeLevelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserBadgeLevelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserBadgeLevel  $userBadgeLevel
     * @return \Illuminate\Http\Response
     */
    public function show(UserBadgeLevel $userBadgeLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserBadgeLevel  $userBadgeLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(UserBadgeLevel $userBadgeLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserBadgeLevelRequest  $request
     * @param  \App\Models\UserBadgeLevel  $userBadgeLevel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserBadgeLevelRequest $request, UserBadgeLevel $userBadgeLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserBadgeLevel  $userBadgeLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserBadgeLevel $userBadgeLevel)
    {
        //
    }
}
