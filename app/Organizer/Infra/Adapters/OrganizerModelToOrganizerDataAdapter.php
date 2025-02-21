<?php

namespace App\Organizer\Infra\Adapters;

use App\Organizer\Infra\OrganizerModel;
use App\Organizer\Domain\Organizer;

class OrganizerModelToOrganizerDataAdapter
{
    public function __construct(
        private OrganizerModel $organizer
    ){
        $this->organizer = $organizer;
    }
    public static function getInstance(OrganizerModel $organizer): self
    {
        return new OrganizerModelToOrganizerDataAdapter($organizer);
    }

    public function toOrganizerData(): Organizer
    {
        return new Organizer(
            $this->organizer->id,
            $this->organizer->name,
            $this->organizer->email,
            $this->organizer->phone_number,
            $this->organizer->address
        );
    }
}