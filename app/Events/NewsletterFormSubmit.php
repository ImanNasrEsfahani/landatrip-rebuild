<?php

namespace App\Events;

use App\Models\Newsletter;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsletterFormSubmit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     *  Newsletter $newsletter
     */
    public Newsletter $newsletter;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
/*    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }*/
}
