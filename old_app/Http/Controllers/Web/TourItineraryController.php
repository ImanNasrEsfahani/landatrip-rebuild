<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTourItineraryRequest;
use App\Http\Requests\UpdateTourItineraryRequest;
use App\Models\TourItinerary;

class TourItineraryController extends Controller
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
     * @param  \App\Http\Requests\StoreTourItineraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourItineraryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourItinerary  $tourItinerary
     * @return \Illuminate\Http\Response
     */
    public function show(TourItinerary $tourItinerary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourItinerary  $tourItinerary
     * @return \Illuminate\Http\Response
     */
    public function edit(TourItinerary $tourItinerary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourItineraryRequest  $request
     * @param  \App\Models\TourItinerary  $tourItinerary
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourItineraryRequest $request, TourItinerary $tourItinerary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourItinerary  $tourItinerary
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourItinerary $tourItinerary)
    {
        //
    }
}
