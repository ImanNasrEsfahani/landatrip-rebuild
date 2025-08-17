<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\UpdateTeacherCouponRequest;
use App\Http\Requests\StoreUserCouponRequest;
use App\Models\UserCoupon;

class UserCouponController extends Controller
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
     * @param  \App\Http\Requests\StoreUserCouponRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserCouponRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCoupon  $userCoupon
     * @return \Illuminate\Http\Response
     */
    public function show(UserCoupon $userCoupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCoupon  $userCoupon
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCoupon $userCoupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\UserPanel\UpdateTeacherCouponRequest  $request
     * @param  \App\Models\UserCoupon  $userCoupon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherCouponRequest $request, UserCoupon $userCoupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCoupon  $userCoupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCoupon $userCoupon)
    {
        //
    }
}
