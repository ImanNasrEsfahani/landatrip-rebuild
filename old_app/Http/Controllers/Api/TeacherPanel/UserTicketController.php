<?php

namespace App\Http\Controllers\Api\TeacherPanel;

use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherPanel\StoreTeacherTicketRequest;
use App\Http\Resources\Teacher\TeacherTicketResource;
use App\Models\Ticket;
use App\Models\TicketRecord;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return TeacherTicketResource::collection(auth()->user()->tickets()->orderBy("status", "ASC")->get());
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
     * @param StoreTeacherTicketRequest $request
     * @return TeacherTicketResource
     */
    public function store(StoreTeacherTicketRequest $request)
    {
        // Store new Ticket
        $ticketObj = new Ticket($request->validated());
        $ticketObj->user()->associate(auth()->user());
        $ticketObj->save();

        // Store the first new Ticket Record
        $ticketRecordObj = new TicketRecord(["message" => $request->validated("message")]);
        $ticketRecordObj->user()->associate(auth()->user());
        $ticketObj->records()->save($ticketRecordObj);

        return new TeacherTicketResource($ticketObj);
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return TeacherTicketResource
     */
    public function show(Ticket $ticket)
    {
        return new TeacherTicketResource($ticket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ticket $ticket
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
     * @param Ticket $ticket
     * @return Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }


    /**
     *
     * @param Ticket $ticket
     * @return string
     */
    public function closeTicketByUser(Ticket $ticket): string
    {
        if(auth()->user()->id === $ticket->user_id) {
            $ticket->status = TicketStatusEnum::closed;
            return $ticket->save();
        }
        return throw abort("403", "You are not Allowed");
    }
}
