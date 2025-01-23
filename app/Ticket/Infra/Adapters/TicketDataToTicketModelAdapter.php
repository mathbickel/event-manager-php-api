<?php

namespace App\Ticket\Infra\Adapters;

use App\Ticket\Domain\TicketData;
use App\Ticket\Infra\TicketModel;
class TicketDataToTicketModelAdapter
{
    public function __construct(
        private TicketData $ticket
    ){
        $this->ticket = $ticket;
    }

    public static function getInstance(TicketData $ticket): self
    {
        return new TicketDataToTicketModelAdapter($ticket);
    }
    protected function toTicketModel(TicketData $ticket): Model
    {
        return new TicketModel($ticket->toArray());
    }
}