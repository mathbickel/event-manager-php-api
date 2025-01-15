<?php

namespace App\Organizer\Infra;

use Illuminate\Database\Eloquent\Model;
use App\Organizer\Domain\Organizer;

class OrganizerModelToOrganizerDataAdapter
{
    public function __construct(
        private OrganizerModel $organizer
    ){
        $this->organizer = $organizer;
    }
    public static function getInstance(Model $organizer): self
    {
        return new OrganizerModelToOrganizerDataAdapter($organizer);
    }

    protected function toOrganizerData(Model $organizer): Organizer
    {
        return new Organizer(
            $organizer->id,
            $organizer->name,
            $organizer->email,
            $organizer->password,
            $organizer->created_at,
            $organizer->updated_at
        );
    }
}