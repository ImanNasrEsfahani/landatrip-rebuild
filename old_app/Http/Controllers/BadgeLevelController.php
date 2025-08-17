<?php

namespace App\Http\Controllers;

use App\Models\BadgeLevel;
use App\Http\Requests\StoreBadgeLevelRequest;
use App\Http\Requests\UpdateBadgeLevelRequest;

class BadgeLevelController extends Controller
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
     * @param  \App\Http\Requests\StoreBadgeLevelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBadgeLevelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BadgeLevel  $badgeLevel
     * @return \Illuminate\Http\Response
     */
    public function show(BadgeLevel $badgeLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BadgeLevel  $badgeLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(BadgeLevel $badgeLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBadgeLevelRequest  $request
     * @param  \App\Models\BadgeLevel  $badgeLevel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBadgeLevelRequest $request, BadgeLevel $badgeLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BadgeLevel  $badgeLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BadgeLevel $badgeLevel)
    {
        //
    }
}
