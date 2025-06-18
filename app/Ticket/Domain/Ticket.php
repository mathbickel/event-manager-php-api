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
            'quantity' => $this->getQuantity(),
            'available_quantity' => $this->getAvailableQuantity(),
            'type' => $this->getType(),
            'status' => $this->getStatus()
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}