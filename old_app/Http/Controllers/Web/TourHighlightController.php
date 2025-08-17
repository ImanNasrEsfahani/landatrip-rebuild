<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTourHighlightRequest;
use App\Http\Requests\UpdateTourHighlightRequest;
use App\Models\TourHighlight;

class TourHighlightController extends Controller
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
     * @param  \App\Http\Requests\StoreTourHighlightRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourHighlightRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourHighlight  $tourHighlight
     * @return \Illuminate\Http\Response
     */
    public function show(TourHighlight $tourHighlight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourHighlight  $tourHighlight
     * @return \Illuminate\Http\Response
     */
    public function edit(TourHighlight $tourHighlight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourHighlightRequest  $request
     * @param  \App\Models\TourHighlight  $tourHighlight
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourHighlightRequest $request, TourHighlight $tourHighlight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourHighlight  $tourHighlight
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourHighlight $tourHighlight)
    {
        //
    }
}
