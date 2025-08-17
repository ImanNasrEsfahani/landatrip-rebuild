<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTourIncludeRequest;
use App\Http\Requests\UpdateTourIncludeRequest;
use App\Models\TourInclude;

class TourIncludeController extends Controller
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
     * @param  \App\Http\Requests\StoreTourIncludeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourIncludeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourInclude  $tourInclude
     * @return \Illuminate\Http\Response
     */
    public function show(TourInclude $tourInclude)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourInclude  $tourInclude
     * @return \Illuminate\Http\Response
     */
    public function edit(TourInclude $tourInclude)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourIncludeRequest  $request
     * @param  \App\Models\TourInclude  $tourInclude
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourIncludeRequest $request, TourInclude $tourInclude)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourInclude  $tourInclude
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourInclude $tourInclude)
    {
        //
    }
}
