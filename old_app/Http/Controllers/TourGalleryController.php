<?php

namespace App\Http\Controllers;

use App\Models\TourGallery;
use App\Http\Requests\StoreTourGalleryRequest;
use App\Http\Requests\UpdateTourGalleryRequest;

class TourGalleryController extends Controller
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
     * @param  \App\Http\Requests\StoreTourGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourGalleryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TourGallery  $tourGallery
     * @return \Illuminate\Http\Response
     */
    public function show(TourGallery $tourGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TourGallery  $tourGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(TourGallery $tourGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourGalleryRequest  $request
     * @param  \App\Models\TourGallery  $tourGallery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourGalleryRequest $request, TourGallery $tourGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TourGallery  $tourGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourGallery $tourGallery)
    {
        //
    }
}
