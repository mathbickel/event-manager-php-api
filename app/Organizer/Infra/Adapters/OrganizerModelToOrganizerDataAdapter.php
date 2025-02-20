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

    public function toOrganizerData(OrganizerModel $organizer): Organizer
    {
        return new Organizer(
            $organizer->id,
            $organizer->name,
            $organizer->email,
            $organizer->phone_number,
            $organizer->address
        );
    }
}