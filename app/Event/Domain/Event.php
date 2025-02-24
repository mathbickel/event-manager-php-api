<?php

namespace App\Event\Domain;

class Event extends EventData
{
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'organizer_id' => $this->getOrganizerId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'location' => $this->getLocation(),
            'address' => $this->getAddress(),
            'start_date' => $this->getStartDate(),
            'end_date' => $this->getEndDate(),
            'start_time' => $this->getStartTime(),
            'end_time' => $this->getEndTime()
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}