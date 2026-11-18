<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ListEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $id;
    public $assign;
    public $user;
    public $userId;
    public $assignId;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id,$assign,$user,$userId,$assignId)
    {
        $this->id = $id;
        $this->assign = $assign;
        $this->user = $user;
        $this->userId = $userId;
        $this->assignId = $assignId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return array_map(
            fn ($userId) => new PrivateChannel('list-channel.'.$userId),
            array_unique([$this->userId, $this->assignId]),
        );
    }
}
