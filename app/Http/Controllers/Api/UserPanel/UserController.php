<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\UpdateUserPersonalInformationRequest;
use App\Http\Resources\User\UserContactInfoDetailResource;
use App\Http\Resources\User\UserInfoResource;
use App\Models\Image;
use App\Models\TemporaryFiles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserContactInfoDetailResource
     */
    public function index()
    {
        return new UserContactInfoDetailResource(auth()->user());
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
     * @return UserContactInfoDetailResource
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
     * @param UpdateUserPersonalInformationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserPersonalInformationRequest $request)
    {
        $save = function ($file = null) use ($request) {
            auth()->user()->update($request->safe()->except('profile_picture'));
            if ($file) {
                abort_unless(in_array($file->type, ['image/jpeg', 'image/png', 'image/webp'], true), 422);
                auth()->user()->images()->updateOrCreate(['image_type' => 'profile'], [
                    'url' => $file->name, 'alt' => 'Profile image',
                ]);
            }
            return response()->json(200);
        };
        return $request->filled('profile_picture')
            ? app(\App\Services\TemporaryUpload::class)->consume($request->validated('profile_picture'), 'users/profile', $save)
            : $save();
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
     * @return UserInfoResource
     */
    public function userInfo()
    {
        return new UserInfoResource(auth()->user());
    }
}
