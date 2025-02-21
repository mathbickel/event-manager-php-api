<?php

namespace App\Notifications\Domain;

use App\Notifications\Domain\NotificationsData;

class Notifications extends NotificationsData
{
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'attendee_id' => $this->getAttendeeId(),
            'message' => $this->getMessage(),
            'status' => $this->getStatus(),
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}