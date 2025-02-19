<?php

namespace App\Organizer\Infra;

use App\Organizer\Domain\Organizer;

class OrganizerModelToOrganizerDataAdapter
{
    public function __construct(
        private Organizer $organizer
    ){
        $this->organizer = $organizer;
    }
    public static function getInstance(): self
    {
        return new OrganizerModelToOrganizerDataAdapter($this->organizer);
    }

    protected function toOrganizerData(Organizer $organizer): Organizer
    {
        return new Organizer(
            $organizer->getId(),
            $organizer->getName(),
            $organizer->getPhoneNumber(),
            $organizer->getAddress(),
            $organizer->getEmail()
        );
    }
}