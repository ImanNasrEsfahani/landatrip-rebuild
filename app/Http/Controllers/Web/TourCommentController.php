<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreTourCommentRequest;
use App\Http\Requests\UpdateTourCommentRequest;
use App\Models\Language;
use App\Models\Tour;
use App\Models\TourComment;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class TourCommentController extends Controller
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
     * @param Tour $tour
     * @param StoreTourCommentRequest $request
     * @return RedirectResponse
     */
    public function store(Tour $tour, StoreTourCommentRequest $request)
    {
        $lang = Language::where('slug', App::getLocale())->first();
        $tourCommentObj = new TourComment($request->validated());
        $tourCommentObj->language()->associate($lang);
        $tourCommentObj->user()->associate(auth()->user());
        $tour->tourComments()->save($tourCommentObj);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param TourComment $tourComment
     * @return \Illuminate\Http\Response
     */
    public function show(TourComment $tourComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TourComment $tourComment
     * @return \Illuminate\Http\Response
     */
    public function edit(TourComment $tourComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourCommentRequest  $request
     * @param TourComment $tourComment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourCommentRequest $request, TourComment $tourComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TourComment $tourComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourComment $tourComment)
    {
        //
    }
}
