<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\StoreTicketRecordRequest;
use App\Http\Requests\UpdateTicketRecordRequest;
use App\Models\TicketRecord;

class TicketRecordController extends Controller
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
     * @param  \App\Http\Requests\Api\Admin\StoreTicketRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketRecord  $ticketRecord
     * @return \Illuminate\Http\Response
     */
    public function show(TicketRecord $ticketRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketRecord  $ticketRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketRecord $ticketRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRecordRequest  $request
     * @param  \App\Models\TicketRecord  $ticketRecord
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRecordRequest $request, TicketRecord $ticketRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketRecord  $ticketRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketRecord $ticketRecord)
    {
        //
    }
}
