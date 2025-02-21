<?php

namespace App\Attendee\Domain;

use App\Attendee\Domain\AttendeeData;

class Attendee extends AttendeeData
{
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'ticket_id' => $this->getTicketId(),
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}