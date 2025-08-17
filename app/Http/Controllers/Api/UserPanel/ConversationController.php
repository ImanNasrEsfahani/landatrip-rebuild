<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\StoreTicketSearchRequest;
use App\Http\Requests\StoreCommunicationRecordRequest;
use App\Http\Requests\StoreCommunicationRequest;
use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\UpdateCommunicationRequest;
use App\Http\Resources\Admin\UserSearchedResource;
use App\Http\Resources\ConversationSearchResource;
use App\Http\Resources\ProviderCommunicationRecordsResource;
use App\Http\Resources\RecordResource;
use App\Http\Resources\User\CommunicationRecordsResource;
use App\Http\Resources\User\ConversationResource;
use App\Models\Conversation;
use App\Models\ConversationRecord;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ConversationResource::collection(Conversation::where('user_id', auth()->id())->orWhere('assigned_by', auth()->id())->get());
    }

    public function tabs(Role $role)
    {
        $communication = Conversation::where("user_id", "=", auth()->user()->id)->get()->filter(function ($item) use ($role) {
            return $item->assignBy()->first()->roles()->first()->name == $role->name;
        });
        return ConversationResource::collection($communication);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommunicationRecordRequest $request,ConversationRecord $conversationRecord)
    {
        $communicationObj = new Conversation([
            "title" => "salam jafar",
        ]);
        $communicationObj->user()->associate(auth()->user());
        $communicationObj->assignBy()->associate($request->assign);
        $communicationObj->save();


        $communicationRecordObj = new ConversationRecord($request->validated());
        $communicationRecordObj->conversation()->associate($communicationObj);
        $communicationRecordObj->user()->associate(auth()->user());
        $communicationRecordObj->save();
        return $communicationObj->id;
//        MessageEvent::dispatch($communicationRecordObj->message, $communicationRecordObj->created_at->diffForHumans(),
//            User::find($communicationRecordObj->user_id)->name,$communicationRecordObj->user_id === auth()->user()->id ? true : false,$communicationRecordObj->seen ? true : false);

    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
//        $communicationRecords = $conversation->records()->where("user_id" , "<>" , auth()->user()->id)->where("is_read", "=", false)->get();
//
//        if ($communicationRecords) {
//            foreach ($communicationRecords as $communicationRecord) {
//                $communicationRecord->update(["is_read" => true]);
//            }
//        }
        return new CommunicationRecordsResource($conversation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conversation $communication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCommunicationRecordRequest $request, $conversation)
    {
        $communicationRecordObj = new ConversationRecord($request->validated());
        $communicationRecordObj->conversation()->associate($conversation);
        $communicationRecordObj->user()->associate(auth()->user());
        $communicationRecordObj->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $communication)
    {
        //
    }

    public function search(StoreConversationRequest $request)
    {
        return ConversationSearchResource::collection(User::where("id" , "<>" , auth()->user()->id)->where('fname', 'like', '%' . $request->get('keyword') . '%')->orWhere('lname', 'like', '%' . $request->get('keyword') . '%')->get());
    }

}
