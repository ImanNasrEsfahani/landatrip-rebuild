<?php

namespace App\Http\Controllers;

use App\Models\CityLanguage;
use App\Http\Requests\StoreCityLanguageRequest;
use App\Http\Requests\UpdateCityLanguageRequest;

class CityLanguageController extends Controller
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
     * @param  \App\Http\Requests\StoreCityLanguageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityLanguageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CityLanguage  $cityLanguage
     * @return \Illuminate\Http\Response
     */
    public function show(CityLanguage $cityLanguage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CityLanguage  $cityLanguage
     * @return \Illuminate\Http\Response
     */
    public function edit(CityLanguage $cityLanguage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCityLanguageRequest  $request
     * @param  \App\Models\CityLanguage  $cityLanguage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityLanguageRequest $request, CityLanguage $cityLanguage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CityLanguage  $cityLanguage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CityLanguage $cityLanguage)
    {
        //
    }
}
