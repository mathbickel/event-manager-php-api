<?php

namespace App\Ticket\Infra\Adapters;

use App\Ticket\Domain\Ticket;
use App\Ticket\Infra\TicketModel;

class TicketModelToTicketDataAdapter
{
    public function __construct(
        private TicketModel $ticket
    ){
        $this->ticket = $ticket;
    }
    public static function getInstance(TicketModel $ticket): self
    {
        return new TicketModelToTicketDataAdapter($ticket);
    }

    protected function toTicketData(Ticket $ticket): Ticket
    {
        return new Ticket(
            $ticket->getId(),
            $ticket->getEventId(),
            $ticket->getPrice(),    
            $ticket->getType(),
            $ticket->getStatus()
        );
    }
}