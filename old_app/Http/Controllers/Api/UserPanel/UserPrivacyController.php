<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPrivacyRequest;
use App\Http\Resources\User\UserPrivacyResource;
use App\Models\PrivacyPolicy;
use App\Models\UserPrivacy;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserPrivacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return UserPrivacyResource::collection(PrivacyPolicy::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return Response
     */
    public function store(PrivacyPolicy $privacyPolicy)
    {

     }

    /**
     * Display the specified resource.
     *
     * @param UserPrivacy $userPrivacy
     * @return Response
     */
    public function show(UserPrivacy $userPrivacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserPrivacy $userPrivacy
     * @return Response
     */
    public function edit(UserPrivacy $userPrivacy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserPrivacyRequest $privacyRequest
     * @param UserPrivacy              $userPrivacy
     *
     * @return bool
     */
    public function update(UpdateUserPrivacyRequest $privacyRequest, UserPrivacy $userPrivacy)
    {
            $userPrivacyObj = UserPrivacy::updateOrCreate(
                [
                    'user_id' => auth()->user()->id,
                    "privacy_policy_id" => $privacyRequest->validated(["privacy_policy_id"]),
                ],
                [
                    'user_id' => auth()->user()->id,
                    "privacy_policy_id" => $privacyRequest->validated(["privacy_policy_id"]),
                    "status" => $privacyRequest->validated(["status"])
                ]
            );
            if(!$userPrivacyObj) return abort(401);
            return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserPrivacy $userPrivacy
     * @return Response
     */
    public function destroy(UserPrivacy $userPrivacy)
    {
        //
    }
}
