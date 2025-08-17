<?php

namespace App\Http\Controllers\Api\TeacherPanel;

use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherPanel\StoreTicketRecordRequest;
use App\Http\Resources\Teacher\TeacherTicketRecordResource;
use App\Models\Ticket;
use App\Models\TicketRecord;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserTicketRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Ticket $ticket)
    {
        return TeacherTicketRecordResource::collection($ticket->records()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Ticket $ticket
     * @param StoreTicketRecordRequest $request
     * @return bool
     */
    public function store(Ticket $ticket, StoreTicketRecordRequest $request)
    {
        $ticketRecord = new TicketRecord($request->validated());
        $ticketRecord->ticket()->associate($ticket);
        $ticketRecord->user()->associate(auth()->user());
        $ticket->status = TicketStatusEnum::pending;
        return $ticketRecord->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Ticket  $ticket
     * @return Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
