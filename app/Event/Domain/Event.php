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
            'address' => $this->getAddress()
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}