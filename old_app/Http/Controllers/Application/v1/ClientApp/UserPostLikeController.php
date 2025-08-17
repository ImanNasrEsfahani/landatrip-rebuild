<?php

namespace App\Http\Controllers\Application\v1\ClientApp;

use App\Http\Controllers\Controller;
use App\Http\Resources\Application\v1\ClientApp\UserPostLikeResource;
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
     * @return bool
     */
    public function store(UserPost $post)
    {
        if (!($post->UserPostLikes()->where("user_id", "=", auth()->user()->id)->count())) {
            $userPostLikeObj = new UserPostLike();
            $userPostLikeObj->user()->associate(auth()->user());
            $userPostLikeObj->userPost()->associate($post);
            return $userPostLikeObj->save();

        }
        return response()->json("This Post has been liked", 402);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserPost $post
     *
     * @return bool|int
     */
    public function destroy(UserPost $post)
    {
        if ($post->UserPostLikes()->where("user_id", "=", auth()->user()->id)->count()) {
            return $post->userPostLikes()->where("user_id", "=", auth()->user()->id)->first()->delete();
        }
        return response()->json("This Post has been dis-liked", 402);
    }
}
