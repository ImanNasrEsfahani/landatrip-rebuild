<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\StoreUserImageProfileRequest;
use App\Models\Image;
use App\Models\TemporaryFiles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserImageProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserImageProfileRequest $request
     * @return Response
     */
    public function store(StoreUserImageProfileRequest $request)
    {
        return app(\App\Services\TemporaryUpload::class)->consume($request->validated('url'), 'users/profile', function ($file) {
            abort_unless(in_array($file->type, ['image/jpeg', 'image/png', 'image/webp'], true), 422);
            return auth()->user()->images()->updateOrCreate(['image_type' => 'profile'], [
                'url' => $file->name, 'alt' => 'Profile image',
            ])->exists;
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool|int
     */
    public function destroy()
    {
        $profileImage = auth()->user()->profileImage()->first();
        if($profileImage) {
            return $profileImage->delete();
        }
       return abort("404", "The file has not deleted.");
    }
}
