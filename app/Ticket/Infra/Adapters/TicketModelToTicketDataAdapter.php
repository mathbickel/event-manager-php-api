<?php

namespace App\Ticket\Infra\Adapters;

use App\Ticket\Domain\Ticket;
use App\Ticket\Infra\TicketModel;

class TicketModelToTicketDataAdapter
{
    public function __construct(
        private TicketModel $ticket
    ){}
    public static function getInstance(TicketModel $ticket): self
    {
        return new TicketModelToTicketDataAdapter($ticket);
    }

    public function toTicketData(): Ticket
    {
        return new Ticket(
            $this->ticket->getId(),
            $this->ticket->getEventId(),
            $this->ticket->getPrice(),    
            $this->ticket->getType(),
            $this->ticket->getStatus()
        );
    }
}