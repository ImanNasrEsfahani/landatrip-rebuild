<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\StoreTeacherEducationRequest;
use App\Http\Requests\Api\UserPanel\UpdateTeacherEducationRequest;
use App\Models\UserEducation;

class UserEducationController extends Controller
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
     * @param  \App\Http\Requests\Api\UserPanel\StoreTeacherEducationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherEducationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserEducation  $userEducation
     * @return \Illuminate\Http\Response
     */
    public function show(UserEducation $userEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserEducation  $userEducation
     * @return \Illuminate\Http\Response
     */
    public function edit(UserEducation $userEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\UserPanel\UpdateTeacherEducationRequest  $request
     * @param  \App\Models\UserEducation  $userEducation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherEducationRequest $request, UserEducation $userEducation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserEducation  $userEducation
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEducation $userEducation)
    {
        //
    }
}
