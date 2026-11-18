<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\StoreTicketRecordRequest;
use App\Http\Resources\User\UserTicketRecordResource;
use App\Models\Article;
use App\Models\GroupPost;
use App\Models\Image;
use App\Models\TemporaryFiles;
use App\Models\Ticket;
use App\Models\TicketRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserTicketRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Ticket $ticket, Request $request): AnonymousResourceCollection
    {
        return UserTicketRecordResource::collection($ticket->records()->with("chatImage")->paginate($request->input("pageSize")));
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
        $save = function ($file = null) use ($request, $ticket) {
            $record = new TicketRecord(['message' => $request->validated('message')]);
            $record->ticket()->associate($ticket);
            $record->user()->associate(auth()->user());
            $record->saveOrFail();
            if ($file) {
                $record->images()->create(['url' => $file->name, 'image_type' => 'chat', 'alt' => 'Ticket attachment']);
            }
            return response()->json(200);
        };
        return $request->filled('image')
            ? app(\App\Services\TemporaryUpload::class)->consume($request->validated('image'), 'users/chat', $save)
            : $save();
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
