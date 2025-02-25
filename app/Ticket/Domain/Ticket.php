<?php

namespace App\Ticket\Domain;

class Ticket extends TicketData
{
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'event_id' => $this->getEventId(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'type' => $this->getType(),
            'status' => $this->getStatus()
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}