<?php

namespace App\Organizer\Infra;

use App\Organizer\Domain\Organizer;

use Illuminate\Database\Eloquent\Model;

class OrganizerDataToOrganizerModelAdapter
{
    public function __construct(
        private Organizer $organizer
    ){
        $this->organizer = $organizer;
    }

    public static function getInstance(Organizer $organizer): self
    {
        return new OrganizerDataToOrganizerModelAdapter($organizer);
    }
    protected function toOrganizerModel(Organizer $organizer): Model
    {
        return new OrganizerModel($organizer->toArray());
    }
}