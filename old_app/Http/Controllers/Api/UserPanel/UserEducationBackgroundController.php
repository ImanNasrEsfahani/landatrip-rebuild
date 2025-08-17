<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\UpdateUserEducationRequest;
use App\Http\Resources\User\UserEducationalBackgroundResource;
use App\Models\UserEducation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class UserEducationBackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return UserEducationalBackgroundResource::collection(auth()->user()->userEducations()->paginate($request->input("pageSize")));
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
     * @param \App\Http\Requests\Api\UserPanel\UpdateUserEducationRequest $request
     * @return UserEducation
     */
    public function store(UpdateUserEducationRequest $request): UserEducation
    {
        return auth()->user()->userEducations()->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param UserEducation $userEducation
     * @return UserEducationalBackgroundResource
     */
    public function show(UserEducation $educational_background)
    {
        return new UserEducationalBackgroundResource(auth()->user()->userEducations()->where("id" , "=" , $educational_background->id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserEducation $userEducation
     * @return void
     */
    public function edit(UserEducation $userEducation): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserEducation $educationalBackground
     * @param UpdateUserEducationRequest $request
     * @return bool
     * @throws Throwable
     */
    public function update(UserEducation $educationalBackground, UpdateUserEducationRequest $request): bool
    {
        return $educationalBackground->updateOrFail($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserEducation $educationalBackground
     * @return bool
     * @throws Throwable
     */
    public function destroy(UserEducation $educationalBackground): bool
    {
        return $educationalBackground->deleteOrFail();
    }
}
