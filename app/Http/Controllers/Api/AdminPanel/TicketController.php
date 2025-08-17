<?php

namespace App\Http\Controllers\Api\AdminPanel;

use App\Enums\TicketPriorityStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Events\RatingTicketEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\StoreTicketRequest;
use App\Http\Requests\Api\Admin\StoreTicketSearchRequest;
use App\Http\Requests\Api\Admin\UpdateTicketRequest;
use App\Http\Resources\Admin\OpenTicketResource;
use App\Http\Resources\Admin\TicketResource;
use App\Http\Resources\Admin\UnasignedTicketResource;
use App\Http\Resources\Admin\UserSearchedResource;
use App\Models\Ticket;
use App\Models\TicketRecord;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
     * @param StoreTicketRequest $request
     * @return Ticket
     */
    public function store(StoreTicketRequest $request)
    {
        foreach ($request->validated("users") as $id) {
            $userObj = User::find($id)->first();
            $ticketObj = new Ticket([
                'title'     =>  $request->validated("title")
            ]);
            $ticketObj->user()->associate($userObj->id);
            $ticketObj->assignedUser()->associate(auth()->user());
            $ticketObj->save();

            $ticketRecordObj = new TicketRecord([
                'message'   =>  $request->validated('message')]);
            $ticketRecordObj->ticket()->associate($ticketObj);
            $ticketRecordObj->user()->associate(auth()->user());
            $ticketRecordObj->save();
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return TicketResource
     */
    public function show(Ticket $ticket)
    {
        return new TicketResource($ticket);
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
     * @param UpdateTicketRequest $request
     * @param Ticket $ticket
     * @return bool
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        return $ticket->update($request->validated());
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
     * @return AnonymousResourceCollection
     */
    public function unassigned()
    {

        return UnasignedTicketResource::collection(Ticket::where("assigned_agent_id", "=", null)->get());
    }


    public function assignMe(Ticket $ticket)
    {
        $ticket->assignedUser()->associate(auth()->user());
        return $ticket->save();
        return UnasignedTicketResource::collection(Ticket::where("status", "=", TicketStatusEnum::new)->get());
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function open()
    {
        $adminTickets = Ticket::where("assigned_agent_id", "=", auth()->user()->id)->get();
        $filtered = $adminTickets->filter(function ($value, $key) {
            return $value->status->value === TicketStatusEnum::new || $value->status->value === TicketStatusEnum::pending || $value->status->value === TicketStatusEnum::answered;
        });
        return OpenTicketResource::collection($filtered->all());
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function archived()
    {
        $adminTickets = Ticket::where("assigned_agent_id", "=", auth()->user()->id)->get();
        $filtered = $adminTickets->filter(function ($value, $key) {
            return $value->status->value === TicketStatusEnum::closed || $value->status->value === TicketStatusEnum::rating;
        });
        return OpenTicketResource::collection($filtered->all());    }

    /**
     * StoreTicketSearchRequest $request
     * @return AnonymousResourceCollection
     */
    public function search(StoreTicketSearchRequest $request)
    {
        return UserSearchedResource::collection(User::where('fname', 'like', '%' . $request->get('keyword') . '%')->orWhere('lname', 'like', '%' . $request->get('keyword') . '%')->get());
    }

    /**
     * @param Ticket $ticket
     *
     * @return string
     */
    public function closeTicket(Ticket $ticket): string
    {
        if(auth()->user()->id === $ticket->assigned_agent_id) {
            $ticket->status = TicketStatusEnum::rating;
            $ticket->save();
            RatingTicketEvent::dispatch($ticket);
            return 1;
        }
        return \response()->json(["data" => "You are not assigned user of this ticket"], 402);
    }
}
