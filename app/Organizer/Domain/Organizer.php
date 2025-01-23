<?php

namespace App\Organizer\Domain;

class Organizer extends OrganizerData
{
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'phone_number' => $this->getPhoneNumber(),
            'address' => $this->getAddress(),
            'email' => $this->getEmail(),
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
}