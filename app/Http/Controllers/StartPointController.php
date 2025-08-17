<?php

namespace App\Http\Controllers;

use App\Models\StartPoint;
use App\Http\Requests\StoreStartPointRequest;
use App\Http\Requests\UpdateStartPointRequest;

class StartPointController extends Controller
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
     * @param  \App\Http\Requests\StoreStartPointRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStartPointRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StartPoint  $startPoint
     * @return \Illuminate\Http\Response
     */
    public function show(StartPoint $startPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StartPoint  $startPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(StartPoint $startPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStartPointRequest  $request
     * @param  \App\Models\StartPoint  $startPoint
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStartPointRequest $request, StartPoint $startPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StartPoint  $startPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(StartPoint $startPoint)
    {
        //
    }
}
