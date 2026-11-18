<?php

namespace App\Http\Controllers\Api\AdminPanel;

use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\StoreTicketRecordRequest;
use App\Http\Resources\Admin\AdminTicketRecordResource;
use App\Models\Ticket;
use App\Models\TicketRecord;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class TicketRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Ticket $ticket):AnonymousResourceCollection
    {
        return AdminTicketRecordResource::collection($ticket->records()->get());
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
     * @return Response
     */
    public function store(Ticket $ticket, StoreTicketRecordRequest $request)
    {
        return DB::transaction(function () use ($ticket, $request) {
            $lockedTicket = Ticket::query()->lockForUpdate()->findOrFail($ticket->id);
            Gate::authorize('accessPanelSupportTicket', $lockedTicket);

            if ($lockedTicket->assigned_agent_id === null) {
                $lockedTicket->assignedUser()->associate($request->user());
                $lockedTicket->save();
            }

            $ticketRecord = new TicketRecord($request->validated());
            $ticketRecord->ticket()->associate($lockedTicket);
            $ticketRecord->user()->associate($request->user());

            return $ticketRecord->save();
        });
    }

    /**
     * Display the specified resource.
     *
     * @param TicketRecord $ticketRecord
     * @return Response
     */
    public function show(TicketRecord $ticketRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TicketRecord $ticketRecord
     * @return Response
     */
    public function edit(TicketRecord $ticketRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TicketRecord $ticketRecord
     * @return Response
     */
    public function update(Request $request, TicketRecord $ticketRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TicketRecord $ticketRecord
     * @return Response
     */
    public function destroy(TicketRecord $ticketRecord)
    {
        //
    }
}
