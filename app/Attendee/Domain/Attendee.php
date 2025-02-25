<?php

namespace App\Attendee\Domain;

use App\Attendee\Domain\AttendeeData;

class Attendee extends AttendeeData
{
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'ticket_id' => $this->getTicketId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'phone_number' => $this->getPhoneNumber()
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}