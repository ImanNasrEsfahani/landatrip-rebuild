<?php

namespace App\Http\Controllers\Application\v1\ClientApp;

use App\Http\Controllers\Controller;
use App\Models\UserPostCommentReply;
use App\Models\UserPostCommentReplyLikes;
use Illuminate\Http\Request;

class LikeCommentRepliesController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostCommentReply $commentReply)
    {
        if(!($commentReply->userPostCommentReplyLikes()->where('user_id',"=",auth()->user()->id)->count())){
            $commentReplyObj= new UserPostCommentReplyLikes();
            $commentReplyObj->user()->associate(auth()->user());
            $commentReplyObj->userPostCommentReply()->associate($commentReply);
            return $commentReplyObj->save();
        }
        return response()->json("this comment has been liked", 402);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPostCommentReply $commentReply)
    {
        if ($commentReply->userPostCommentReplyLikes()->where("user_id","=",auth()->user()->id)->count()) {
        return $commentReply->userPostCommentReplyLikes()->where("user_id","=",auth()->user()->id)->first()->delete();
      }
    return response()->json("this comment has been dis_liked",402);
     }
}
