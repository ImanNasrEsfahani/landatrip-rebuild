<?php

namespace App\Http\Controllers\Api\TeacherPanel;

use App\Http\Controllers\Controller;
use App\Http\Resources\Teacher\TeacherAgreementDetailResource;
use App\Http\Resources\Teacher\TeacherAgreementResource;
use App\Models\UserAgreement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return TeacherAgreementResource::collection(auth()->user()->agreements()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param UserAgreement $userAgreement
     * @return TeacherAgreementDetailResource
     */
    public function show(UserAgreement $userAgreement)
    {
        return new TeacherAgreementDetailResource($userAgreement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function edit(UserAgreement $userAgreement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param UserAgreement $userAgreement
     * @return bool
     */
    public function update(Request $request, UserAgreement $userAgreement)
    {
        return $userAgreement->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function destroy(UserAgreement $userAgreement)
    {
        //
    }
}
