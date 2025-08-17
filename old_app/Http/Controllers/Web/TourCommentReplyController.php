<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreTourCommentReplyRequest;
use App\Http\Requests\UpdateTourCommentReplyRequest;
use App\Models\Tour;
use App\Models\TourComment;
use App\Models\TourCommentReply;
use Carbon\Carbon;

class TourCommentReplyController extends Controller
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
     * @param StoreTourCommentReplyRequest $request
     * @return bool
     */
    public function store(TourComment $tourComment, StoreTourCommentReplyRequest $request)
    {
        $tourCommentReply = new TourCommentReply($request->validated());
        $tourCommentReply->tourComment()->associate($tourComment);
        $tourCommentReply->user()->associate(auth()->user());
        return $tourCommentReply->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourCommentReply  $tourCommentReply
     * @return \Illuminate\Http\Response
     */
    public function show(TourCommentReply $tourCommentReply)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourCommentReply  $tourCommentReply
     * @return \Illuminate\Http\Response
     */
    public function edit(TourCommentReply $tourCommentReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourCommentReplyRequest  $request
     * @param  \App\Models\TourCommentReply  $tourCommentReply
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourCommentReplyRequest $request, TourCommentReply $tourCommentReply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourCommentReply  $tourCommentReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourCommentReply $tourCommentReply)
    {
        //
    }
}
