<?php

namespace App\Observers;

use App\Events\ListEvent;
use App\Events\MessageEvent;
use App\Http\Resources\AssignListResource;
use App\Http\Resources\User\ConversationResource;
use App\Http\Resources\UserListResource;
use App\Models\Conversation;
use App\Models\ConversationRecord;
use App\Models\User;
use Carbon\Carbon;


class ConversationRecordObserver
{
    /**
     * Handle the ConversationRecord "created" event.
     *
     * @param  \App\Models\ConversationRecord  $conversationRecord
     * @return void
     */
    public function created(ConversationRecord $conversationRecord)
    {
        $conversationObj = $conversationRecord->conversation()->first();
            $conversationObj->updated_at = Carbon::now();
            $conversationObj->save();
        MessageEvent::dispatch($conversationRecord->conversation->id,$conversationRecord->message, Carbon::now()->diffForHumans(),
            User::find($conversationRecord->user_id)->name,$conversationRecord->user_id,$conversationRecord->seen ? true : false);
        ListEvent::dispatch($conversationRecord->conversation->id,new AssignListResource($conversationRecord->conversation),
            new UserListResource($conversationRecord->conversation),$conversationRecord->conversation->user_id,$conversationRecord->conversation->assigned_by);
    }

  /**
     * Handle the ConversationRecord "created" event.
     *
     * @param  \App\Models\ConversationRecord  $conversationRecord
     * @return void
     */
    public function creating(ConversationRecord $conversationRecord)
    {
        //
    }

    /**
     * Handle the ConversationRecord "updated" event.
     *
     * @param  \App\Models\ConversationRecord  $conversationRecord
     * @return void
     */
    public function updated(ConversationRecord $conversationRecord)
    {
//        $conversationRecord->conversation->updated_at->update(Carbon::now());
//        event(new MessageEvent($conversationRecord->message, $conversationRecord->created_at->diffForHumans(),
//            User::find($conversationRecord->user_id)->name,$conversationRecord->user_id === auth()->user()->id ? true : false,$conversationRecord->seen ? true : false));
    }

    /**
     * Handle the ConversationRecord "deleted" event.
     *
     * @param  \App\Models\ConversationRecord  $conversationRecord
     * @return void
     */
    public function deleted(ConversationRecord $conversationRecord)
    {
        //
    }

    /**
     * Handle the ConversationRecord "restored" event.
     *
     * @param  \App\Models\ConversationRecord  $conversationRecord
     * @return void
     */
    public function retrieved(ConversationRecord $conversationRecord)
    {
        if($conversationRecord->user_id !== auth()->user()->id) {
            $conversationRecord->update(["seen" => Carbon::now()]);
        }
    }

    /**
     * Handle the ConversationRecord "restored" event.
     *
     * @param  \App\Models\ConversationRecord  $conversationRecord
     * @return void
     */
    public function restored(ConversationRecord $conversationRecord)
    {
        //
    }

    /**
     * Handle the ConversationRecord "force deleted" event.
     *
     * @param  \App\Models\ConversationRecord  $conversationRecord
     * @return void
     */
    public function forceDeleted(ConversationRecord $conversationRecord)
    {
        //
    }
}
