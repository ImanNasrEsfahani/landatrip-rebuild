<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\StoreUserAgreementRequest;
use App\Http\Resources\User\UserAgreementDetailResource;
use App\Http\Resources\User\UserAgreementResource;
use App\Models\Agreement;
use App\Models\UserAgreement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return UserAgreementResource::collection(auth()->user()->agreements()->paginate($request->input("pageSize")));
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
     * @param UserAgreement $userAgreement
     * @return UserAgreementDetailResource
     */
    public function show(Agreement $agreement)
    {
        return new UserAgreementDetailResource(auth()->user()->agreements()->where("agreement_id", "=", $agreement->id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function edit(UserAgreement $userAgreement): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Agreement                 $agreement
     * @param StoreUserAgreementRequest $request
     * @return bool
     */
    public function update(Agreement $agreement, StoreUserAgreementRequest $request): bool
    {
        $agreementObj = UserAgreement::where("agreement_id", "=", $agreement->id)->where("user_id", "=", auth()->user()->id)->first();
        return $agreementObj->updateOrFail($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function destroy(UserAgreement $userAgreement): void
    {
        //
    }
}
