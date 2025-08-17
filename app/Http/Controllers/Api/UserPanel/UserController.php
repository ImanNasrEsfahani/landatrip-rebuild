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
        auth()->user()->update($request->validated());
        $tempObj = TemporaryFiles::find($request->validated("profile_picture"));

        if($tempObj) {
            $moved = Storage::disk('public')->move("tmp-files/" . $tempObj->name, "/users/profile/" . $tempObj->name);
            if($moved) {
                $tempObj->delete();
                $imageObj = Image::updateOrCreate([
                    'parentable_id'     =>  auth()->user()->id,
                    'parentable_type'   =>  User::class
                ],
                    [
                        "url"   =>  $tempObj->name,
                        "image_type"   =>  "profile",
                        "alt"   =>  auth()->user()->name . " - " . config("name")
                    ]);
                auth()->user()->images()->save($imageObj);
            }
        }
        return \response()->json(200);
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
