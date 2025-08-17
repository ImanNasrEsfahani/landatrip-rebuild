<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTourExcludeRequest;
use App\Http\Requests\UpdateTourExcludeRequest;
use App\Models\TourExclude;

class TourExcludeController extends Controller
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
     * @param  \App\Http\Requests\StoreTourExcludeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourExcludeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourExclude  $tourExclude
     * @return \Illuminate\Http\Response
     */
    public function show(TourExclude $tourExclude)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourExclude  $tourExclude
     * @return \Illuminate\Http\Response
     */
    public function edit(TourExclude $tourExclude)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourExcludeRequest  $request
     * @param  \App\Models\TourExclude  $tourExclude
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourExcludeRequest $request, TourExclude $tourExclude)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourExclude  $tourExclude
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourExclude $tourExclude)
    {
        //
    }
}
