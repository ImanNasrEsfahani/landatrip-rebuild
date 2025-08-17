<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCouponResource;
use App\Models\User;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return UserCouponResource::collection(auth()->user()->coupons()->paginate($request->input('pageSize')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param UserCoupon $userCoupon
     * @return void
     */
    public function show(UserCoupon $userCoupon): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserCoupon $userCoupon
     * @return void
     */
    public function edit(UserCoupon $userCoupon): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param UserCoupon $userCoupon
     * @return void
     */
    public function update(Request $request, UserCoupon $userCoupon): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserCoupon $userCoupon
     * @return void
     */
    public function destroy(UserCoupon $userCoupon): void
    {
        //
    }
}
