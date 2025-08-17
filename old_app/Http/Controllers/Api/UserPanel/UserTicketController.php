<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Enums\TicketPriorityStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\StoreUserTicketRequest;
use App\Http\Requests\Api\UserPanel\UpdateUserTicketCloseRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\User\UserTicketResource;
use App\Models\Ticket;
use App\Models\TicketRecord;
use BenSampo\Enum\Rules\EnumValue;
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
    public function index(Request $request): AnonymousResourceCollection
    {
        return UserTicketResource::collection(auth()->user()->tickets()->orderBy("status", "ASC")->paginate($request->input('pageSize')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserTicketRequest $request
     * @return UserTicketResource
     */
    public function store(StoreUserTicketRequest $request): UserTicketResource
    {
        // Store new Ticket
        $ticketObj = new Ticket($request->validated());
        $ticketObj->user()->associate(auth()->user());
        $ticketObj->save();

        // Store the first new Ticket Record
        $ticketRecordObj = new TicketRecord(["message" => $request->validated("message")]);
        $ticketRecordObj->user()->associate(auth()->user());
        $ticketObj->records()->save($ticketRecordObj);

        return new UserTicketResource($ticketObj);
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return UserTicketResource
     */
    public function show(Ticket $ticket): UserTicketResource
    {
        return new UserTicketResource($ticket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ticket $ticket
     * @return void
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
     * @return void
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * @return void
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
    public function ratingTicketRatingStore(Ticket $ticket)
    {
        return "test";
    }

    /**
     *
     * @param Ticket $ticket
     * @return string
     */
    public function closeTicketByUser(UpdateUserTicketCloseRequest $request, Ticket $ticket): string
    {
        if(auth()->user()->id === $ticket->user_id) {
            $ticket->status = TicketStatusEnum::closed;
            $ticket->update(($request->validated()));
            return $ticket->save();
        }
        return \response()->json(["data" => "You are not assigned user of this ticket"], 402);
    }
}
