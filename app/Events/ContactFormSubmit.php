<?php

namespace App\Events;

use App\Models\Contact;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     *  Contact $contact
     */
    public Contact $contact;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
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
