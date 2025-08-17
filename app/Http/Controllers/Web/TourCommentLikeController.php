<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreTourCommentLikeRequest;
use App\Http\Requests\UpdateTourCommentLikeRequest;
use App\Models\Tour;
use App\Models\TourComment;
use App\Models\TourCommentLike;
use App\Models\UserPostCommentLike;

class TourCommentLikeController extends Controller
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
     * @param  \App\Http\Requests\Api\Web\StoreTourCommentLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourCommentLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourCommentLike  $tourCommentLike
     * @return \Illuminate\Http\Response
     */
    public function show(TourCommentLike $tourCommentLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourCommentLike  $tourCommentLike
     * @return \Illuminate\Http\Response
     */
    public function edit(TourCommentLike $tourCommentLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourCommentLikeRequest  $request
     * @param  \App\Models\TourCommentLike  $tourCommentLike
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourCommentLikeRequest $request, TourCommentLike $tourCommentLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourCommentLike  $tourCommentLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourCommentLike $tourCommentLike)
    {
        //
    }

    public function like(TourComment $tourComment)
    {
        if(!($tourComment->tourCommentLikes()->where('user_id', "=", auth()->user()->id)->count())) {
            $commentLikeObj = new TourCommentLike();
            $commentLikeObj->user()->associate(auth()->user());
            $commentLikeObj->tourComment()->associate($tourComment);
            return $commentLikeObj->save();
        }
        return response()->json("this post has been liked", 402);
    }

    public function dislike( TourComment $tourComment)
    {
        if($tourComment->tourCommentLikes()->where("user_id","=",auth()->user()->id)->count()) {
            return $tourComment->tourCommentLikes()->where("user_id","=",auth()->user()->id)->first()->delete();
        }
        return response()->json("this comment has been dis-liked",402);

    }
}
