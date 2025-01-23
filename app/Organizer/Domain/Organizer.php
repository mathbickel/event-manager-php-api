<?php

namespace App\Organizer\Domain;

class Organizer extends OrganizerData
{
    protected function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'phone_number' => $this->getPhoneNumber(),
            'address' => $this->getAddress(),
            'email' => $this->getEmail(),
        ];
    }

    protected function toString(): string
    {
        return json_encode($this->toArray());
    }
}