<?php

namespace App\Http\Controllers;

use App\Models\UserPostSave;
use App\Http\Requests\StoreUserPostSaveRequest;
use App\Http\Requests\UpdateUserPostSaveRequest;

class UserPostSaveController extends Controller
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
     * @param  \App\Http\Requests\StoreUserPostSaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPostSaveRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPostSave  $userPostSave
     * @return \Illuminate\Http\Response
     */
    public function show(UserPostSave $userPostSave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPostSave  $userPostSave
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPostSave $userPostSave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserPostSaveRequest  $request
     * @param  \App\Models\UserPostSave  $userPostSave
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPostSaveRequest $request, UserPostSave $userPostSave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPostSave  $userPostSave
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPostSave $userPostSave)
    {
        //
    }
}
