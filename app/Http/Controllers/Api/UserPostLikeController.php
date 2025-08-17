<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreUserPostLikeRequest;
use App\Http\Resources\UserPostLikeResource;
use App\Models\User;
use App\Models\UserPost;
use App\Models\UserPostLike;
use Illuminate\Http\Request;

class UserPostLikeController extends Controller
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
     * @param UserPost $post
     *
     * @return UserPostLikeResource
     */
    public function store(User $user, UserPost $post)
    {
        $userPostLikeObj = new UserPostLike();
        $userPostLikeObj->user()->associate(auth()->user());
        $userPostLikeObj->userPost()->associate($post);
        $userPostLikeObj->save();
        return new UserPostLikeResource($post);
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
     * @param User $user
     * @param UserPost $post
     * @return bool|int
     */
    public function destroy(User $user, UserPost $post)
    {
        return $post->userPostLikes()->where("user_id", "=", auth()->user()->id)->first()->delete();
    }
}
