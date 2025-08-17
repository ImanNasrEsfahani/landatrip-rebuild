<?php

namespace App\Http\Controllers;

use App\Models\GroupItinerary;
use App\Http\Requests\StoreGroupItineraryRequest;
use App\Http\Requests\UpdateGroupItineraryRequest;

class GroupItineraryController extends Controller
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
     * @param  \App\Http\Requests\StoreGroupItineraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupItineraryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupItinerary  $groupItinerary
     * @return \Illuminate\Http\Response
     */
    public function show(GroupItinerary $groupItinerary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupItinerary  $groupItinerary
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupItinerary $groupItinerary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupItineraryRequest  $request
     * @param  \App\Models\GroupItinerary  $groupItinerary
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupItineraryRequest $request, GroupItinerary $groupItinerary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupItinerary  $groupItinerary
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupItinerary $groupItinerary)
    {
        //
    }
}
