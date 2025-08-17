<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTermAndConditionRequest;
use App\Http\Requests\UpdateTermAndConditionRequest;
use App\Models\TermAndCondition;

class TermAndConditionController extends Controller
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
     * @param  \App\Http\Requests\StoreTermAndConditionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTermAndConditionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermAndCondition  $termAndCondition
     * @return \Illuminate\Http\Response
     */
    public function show(TermAndCondition $termAndCondition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermAndCondition  $termAndCondition
     * @return \Illuminate\Http\Response
     */
    public function edit(TermAndCondition $termAndCondition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTermAndConditionRequest  $request
     * @param  \App\Models\TermAndCondition  $termAndCondition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTermAndConditionRequest $request, TermAndCondition $termAndCondition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermAndCondition  $termAndCondition
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermAndCondition $termAndCondition)
    {
        //
    }
}
