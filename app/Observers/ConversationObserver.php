<?php

namespace App\Observers;

use App\Events\ListEvent;
use App\Events\ListUpdateEvent;
use App\Http\Resources\AssignListResource;
use App\Http\Resources\User\ConversationResource;
use App\Http\Resources\UserListResource;
use App\Models\Conversation;


class ConversationObserver
{
    /**
     * Handle the Conversation "created" event.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return void
     */
    public function created(Conversation $conversation)
    {
        ListEvent::dispatch($conversation->id,new AssignListResource($conversation),new UserListResource($conversation),$conversation->user_id,$conversation->assigned_by);
    }

    /**
     * Handle the Conversation "updated" event.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return void
     */
    public function updated(Conversation $conversation)
    {
    }

    /**
     * Handle the Conversation "deleted" event.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return void
     */
    public function deleted(Conversation $conversation)
    {
        //
    }

    /**
     * Handle the Conversation "restored" event.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return void
     */
    public function restored(Conversation $conversation)
    {
        //
    }

    public function retrieved(Conversation $conversation)
    {

    }

    /**
     * Handle the Conversation "force deleted" event.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return void
     */
    public function forceDeleted(Conversation $conversation)
    {
        //
    }
}
