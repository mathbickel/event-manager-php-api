<?php

namespace App\Organizer\Infra;

use App\Organizer\Domain\OrganizerData;
use Illuminate\Database\Eloquent\Model;

class OrganizerDataToOrganizerModelAdapter
{
    public function __construct(
        private OrganizerData $organizer
    ){
        $this->organizer = $organizer;
    }

    public static function getInstance(OrganizerData $organizer): self
    {
        return new OrganizerDataToOrganizerModelAdapter($organizer);
    }
    protected function toOrganizerModel(OrganizerData $organizer): Model
    {
        return new OrganizerModel($organizer->toArray());
    }
}