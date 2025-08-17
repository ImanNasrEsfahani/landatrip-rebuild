<?php

namespace App\Observers;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\TicketRecord;
use function PHPUnit\Framework\isNull;

class TicketRecordObserver
{
    /**
     * @param TicketRecord $ticketRecord
     * @return void
     */
    public  function  creating(TicketRecord $ticketRecord)
    {
        //
    }

    /**
     * Handle the TicketRecord "created" event.
     *
     * @param TicketRecord $ticketRecord
     * @return void
     */
    public function created(TicketRecord $ticketRecord)
    {
        $ticket = $ticketRecord->ticket()->first();

        if ($ticketRecord->ticket->status->value === TicketStatusEnum::answered && $ticketRecord->user()->first()->hasRole(["user", "teacher"])) {
            $ticketRecord->ticket->status = TicketStatusEnum::pending;
        }
        if($ticketRecord->ticket->status->value === TicketStatusEnum::pending && $ticketRecord->user()->first()->hasRole(["admin", "manager"])) {
            $ticketRecord->ticket->status = TicketStatusEnum::answered;
        }
        if ($ticketRecord->ticket->status->value === TicketStatusEnum::new && $ticketRecord->user()->first()->hasRole(["user", "teacher"])) {
            $collection = $ticket->records()->get();
            $filtered = $collection->filter(function ($value, $key) {
                return $value->user()->first()->hasRole(["admin", "manager"]);
            });
//            dd($filtered->all());
            if($filtered->all())
            {
                $ticketRecord->ticket->status = TicketStatusEnum::pending;
            } else {
                $ticketRecord->ticket->status = TicketStatusEnum::new;
            }
        }

        if($ticketRecord->ticket->status->value === TicketStatusEnum::new && $ticketRecord->user()->first()->hasRole(["admin", "manager"])) {
            $collection = $ticket->records()->get();
            $filtered = $collection->filter(function ($value, $key) {
                return $value->user()->first()->hasRole(["user", "teacher"]);
            });

            if($filtered->all()) {
                $ticketRecord->ticket->status = TicketStatusEnum::answered;
            } else {
                $ticketRecord->ticket->status = TicketStatusEnum::new;
            }
        }

        $ticketRecord->ticket->save();
    }

    /**
     * Handle the TicketRecord "updated" event.
     *
     * @param TicketRecord $ticketRecord
     * @return void
     */
    public function updated(TicketRecord $ticketRecord)
    {
        //
    }

    /**
     * Handle the TicketRecord "deleted" event.
     *
     * @param TicketRecord $ticketRecord
     * @return void
     */
    public function deleted(TicketRecord $ticketRecord)
    {
        //
    }

    /**
     * Handle the TicketRecord "restored" event.
     *
     * @param TicketRecord $ticketRecord
     * @return void
     */
    public function restored(TicketRecord $ticketRecord)
    {
        //
    }

    /**
     * Handle the TicketRecord "force deleted" event.
     *
     * @param TicketRecord $ticketRecord
     * @return void
     */
    public function forceDeleted(TicketRecord $ticketRecord)
    {
        //
    }
}
