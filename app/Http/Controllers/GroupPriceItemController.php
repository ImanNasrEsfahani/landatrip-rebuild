<?php

namespace App\Http\Controllers;

use App\Models\GroupPriceItem;
use App\Http\Requests\StoreGroupPriceItemRequest;
use App\Http\Requests\UpdateGroupPriceItemRequest;

class GroupPriceItemController extends Controller
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
     * @param  \App\Http\Requests\StoreGroupPriceItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupPriceItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupPriceItem  $groupPriceItem
     * @return \Illuminate\Http\Response
     */
    public function show(GroupPriceItem $groupPriceItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupPriceItem  $groupPriceItem
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupPriceItem $groupPriceItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupPriceItemRequest  $request
     * @param  \App\Models\GroupPriceItem  $groupPriceItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupPriceItemRequest $request, GroupPriceItem $groupPriceItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupPriceItem  $groupPriceItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupPriceItem $groupPriceItem)
    {
        //
    }
}
