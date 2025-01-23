<?php

namespace App\Ticket\Domain;

class Ticket extends TicketData
{
    protected function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'event_id' => $this->getEventId(),
            'price' => $this->getPrice(),
            'type' => $this->getType(),
            'status' => $this->getStatus()
        ];
    }

    protected function toString(): string
    {
        return json_encode($this->toArray());
    }
}