<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\StoreTeacherAgreementRequest;
use App\Http\Requests\Api\UserPanel\UpdateTeacherAgreementRequest;
use App\Models\UserAgreement;

class UserAgreementController extends Controller
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
     * @param  \App\Http\Requests\Api\UserPanel\StoreTeacherAgreementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherAgreementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAgreement  $userAgreement
     * @return \Illuminate\Http\Response
     */
    public function show(UserAgreement $userAgreement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAgreement  $userAgreement
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAgreement $userAgreement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\UserPanel\UpdateTeacherAgreementRequest  $request
     * @param  \App\Models\UserAgreement  $userAgreement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherAgreementRequest $request, UserAgreement $userAgreement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAgreement  $userAgreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAgreement $userAgreement)
    {
        //
    }
}
