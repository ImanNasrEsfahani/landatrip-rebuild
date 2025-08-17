<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPost;
use App\Models\UserPostComment;
use App\Models\UserPostCommentLike;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserPostCommentLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
    public function store(User $user,UserPost $post,UserPostComment $comment)
    {
        $userPostCommentLikeObj = new UserPostCommentLike();
        $userPostCommentLikeObj->user()->associate(auth()->user());
        $userPostCommentLikeObj->userPostComment()->associate($comment);
        return $userPostCommentLikeObj->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
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
    public function destroy(User $user,UserPost $post,UserPostComment $comment)
    {
        return $comment->userPostCommentLikes()->where("user_id","=",auth()->user()->id)->first()->delete();
    }
}
