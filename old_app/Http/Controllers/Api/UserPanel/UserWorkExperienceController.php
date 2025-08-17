<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\UpdateUserWorkExperienceRequest;
use App\Http\Resources\User\UserWorkExperienceResource;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserWorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request):AnonymousResourceCollection
    {
        return UserWorkExperienceResource::collection(auth()->user()->userCompanies()->paginate($request->input("pageSize")));
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
     * @param UpdateUserWorkExperienceRequest $request
     * @return UserCompany
     */
    public function store(UpdateUserWorkExperienceRequest $request , UserCompany $work_experience): UserCompany
    {
        return auth()->user()->userCompanies()->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param UserCompany $userCompany
     * @return AnonymousResourceCollection
     */
    public function show(UserCompany $userCompany,Request $request)
    {
        dd($request);
        return UserWorkExperienceResource::collection(auth()->user()->userCompanies()->where("id" , "=" , $request)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserCompany $userCompany
     * @return void
     */
    public function edit(UserCompany $userCompany): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\UserPanel\UpdateUserWorkExperienceRequest $request
     * @param UserCompany $userCompany
     * @return bool
     */
    public function update(UpdateUserWorkExperienceRequest $request, UserCompany $work_experience): bool
    {
        return $work_experience->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserCompany $userCompany
     * @return bool|null
     */
    public function destroy(UserCompany $work_experience): bool|null
    {
        return $work_experience->delete();
    }
}
