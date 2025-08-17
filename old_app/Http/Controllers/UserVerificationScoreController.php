<?php

namespace App\Http\Controllers;

use App\Models\UserVerificationScore;
use App\Http\Requests\StoreUserVerificationScoreRequest;
use App\Http\Requests\UpdateUserVerificationScoreRequest;

class UserVerificationScoreController extends Controller
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
     * @param  \App\Http\Requests\StoreUserVerificationScoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserVerificationScoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserVerificationScore  $userVerificationScore
     * @return \Illuminate\Http\Response
     */
    public function show(UserVerificationScore $userVerificationScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserVerificationScore  $userVerificationScore
     * @return \Illuminate\Http\Response
     */
    public function edit(UserVerificationScore $userVerificationScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserVerificationScoreRequest  $request
     * @param  \App\Models\UserVerificationScore  $userVerificationScore
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserVerificationScoreRequest $request, UserVerificationScore $userVerificationScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserVerificationScore  $userVerificationScore
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserVerificationScore $userVerificationScore)
    {
        //
    }
}
