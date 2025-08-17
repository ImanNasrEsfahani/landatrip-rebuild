<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreTourCommentReplyLikeRequest;
use App\Http\Requests\UpdateTourCommentReplyLikeRequest;
use App\Models\Tour;
use App\Models\TourComment;
use App\Models\TourCommentReply;
use App\Models\TourCommentReplyLike;

class TourCommentReplyLikeController extends Controller
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
     * @param  \App\Http\Requests\Api\Web\StoreTourCommentReplyLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourCommentReplyLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourCommentReplyLike  $tourCommentReplyLike
     * @return \Illuminate\Http\Response
     */
    public function show(TourCommentReplyLike $tourCommentReplyLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourCommentReplyLike  $tourCommentReplyLike
     * @return \Illuminate\Http\Response
     */
    public function edit(TourCommentReplyLike $tourCommentReplyLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourCommentReplyLikeRequest  $request
     * @param  \App\Models\TourCommentReplyLike  $tourCommentReplyLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourCommentReplyLikeRequest $request, TourCommentReplyLike $tourCommentReplyLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourCommentReplyLike  $tourCommentReplyLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourCommentReplyLike $tourCommentReplyLike)
    {
        //
    }

    public function like(TourCommentReply $tourCommentReply)
    {
        if(!($tourCommentReply->tourCommentReplyLikes()->where('user_id',"=",auth()->user()->id)->count())){
            $commentReplyObj= new TourCommentReplyLike();
            $commentReplyObj->user()->associate(auth()->user());
            $commentReplyObj->tourCommentReply()->associate($tourCommentReply);
            return $commentReplyObj->save();
        }
        return response()->json("this comment has been liked", 402);
    }

    public function dislike(TourCommentReply $tourCommentReply)
    {
        if ($tourCommentReply->tourCommentReplyLikes()->where("user_id","=",auth()->user()->id)->count()) {
            return $tourCommentReply->tourCommentReplyLikes()->where("user_id","=",auth()->user()->id)->first()->delete();
        }
        return response()->json("this comment has been dis_liked",402);
    }
}
