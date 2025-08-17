<?php

namespace App\Http\Controllers\Api\TeacherPanel;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherPanel\UpdateTeacherPersonalInformationRequest;
use App\Http\Resources\Teacher\TeacherInfoResource;
use App\Http\Resources\Teacher\TeacherContactInfoDetailResource;
use App\Http\Resources\User\UserInfoResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TeacherContactInfoDetailResource
     */
    public function index()
    {
        return new TeacherContactInfoDetailResource(auth()->user());
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(UpdateTeacherPersonalInformationRequest $request, User $user)
    {
        return auth()->user()->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * User general information like name and profile image and wallet
     * @return TeacherInfoResource
     */
    public function userInfo()
    {
        return new TeacherInfoResource(auth()->user());
    }
}
