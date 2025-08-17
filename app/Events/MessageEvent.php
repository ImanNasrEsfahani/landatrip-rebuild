<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $id;
    public $message;
    public $date;
    public $name;
    public $conversation_id;
    public $is_read;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $message, $date, $name, $conversation_id, $is_read)
    {
        $this->id = $id;
        $this->message = $message;
        $this->date = $date;
        $this->name = $name;
        $this->conversation_id = $conversation_id;
        $this->is_read = $is_read;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.'.$this->id);
    }

//    public function broadcastAs()
//    {
//        return "message";
//    }

//    public function broadcastWith()
//    {
//        return [
//            'id'      => $this->id,
//            'message' => $this->message,
//            'date'    => $this->date,
//            'name'    => $this->name,
//            'is_sender' => $this->is_sender,
//            'is_read' => $this->is_read
//            ];
//    }
}
