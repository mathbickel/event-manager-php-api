<?php

namespace App\Ticket\Infra\Adapters;

use App\Ticket\Domain\Ticket;
use App\Ticket\Infra\TicketModel;
use Illuminate\Database\Eloquent\Model;

class TicketModelToTicketDataAdapter
{
    public function __construct(
        private TicketModel $ticket
    ){
        $this->ticket = $ticket;
    }
    public static function getInstance(Model $ticket): self
    {
        return new TicketModelToTicketDataAdapter($ticket);
    }

    protected function toTicketData(Model $ticket): Ticket
    {
        return new Ticket(
            $ticket->id,
            $ticket->title,
            $ticket->description,
            $ticket->status,
            $ticket->created_at,
            $ticket->updated_at
        );
    }
}