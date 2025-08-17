<?php

namespace App\Http\Controllers\Api\TeacherPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherPanel\UpdateTeacherChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(): void
    {
        //
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
     * @param User $user
     * @return void
     */
    public function show(User $user): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function edit(User $user): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTeacherChangePasswordRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UpdateTeacherChangePasswordRequest $request, User $user)
    {
        $userAuth = User::find(auth()->user()->id);
        if (Hash::check($request->validated("old_password"), $userAuth->password)) {
            $userAuth->password = Hash::make($request->validated("password"));
            return $userAuth->save();
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     */
    public function destroy(User $user): void
    {
        //
    }
}
