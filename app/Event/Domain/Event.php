<?php

namespace App\Event\Domain;

class Event extends EventData
{
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'start_date' => $this->getStartDate(),
            'end_date' => $this->getEndDate(),
            'address' => $this->getAddress(),
            'organizer_id' => $this->getOrganizerId(),
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}