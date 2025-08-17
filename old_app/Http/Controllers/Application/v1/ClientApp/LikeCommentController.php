<?php

namespace App\Http\Controllers\Application\v1\ClientApp;

use App\Http\Controllers\Controller;
use App\Models\UserPostComment;
use App\Models\UserPostCommentLike;
use Illuminate\Http\Request;

class LikeCommentController extends Controller
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
     */
    public function store(UserPostComment $comment)
    {
        if(!($comment->userPostCommentLikes()->where('user_id', "=", auth()->user()->id)->count())) {
        $commentLikeObj= new UserPostCommentLike();
        $commentLikeObj->user()->associate(auth()->user());
        $commentLikeObj->userPostComment()->associate($comment);
        return  $commentLikeObj->save();

        }
         return response()->json("this post has been liked", 402);
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
    public function destroy(UserPostComment $comment)
    {
        if($comment->userPostCommentLikes()->where("user_id","=",auth()->user()->id)->count()) {
            return $comment->userPostCommentLikes()->where("user_id","=",auth()->user()->id)->first()->delete();
        }
        return response()->json("this comment has been dis-liked",402);
    }
}
