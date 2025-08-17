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
        $ticketRecord = new TicketRecord($request->validated());
        $ticketRecord->ticket()->associate($ticket);
        $ticketRecord->user()->associate(auth()->user());
        $ticketRecord->save();
        $tempObj = TemporaryFiles::find($request->validated("image"));
        if($tempObj) {
            $moved = Storage::disk('public')->move("tmp-files/" . $tempObj->name, "/users/chat/" . $tempObj->name);
            if($moved) {
                $tempObj->delete();
                $imageObj = new Image(
                    [
                        "url"   =>  $tempObj->name,
                        "image_type"   =>  "chat",
                        "alt"   =>  auth()->user()->name . " - " . config("name")
                    ]);
                $ticketRecord->images()->save($imageObj);
            }
        }
        return \response()->json(200);
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
