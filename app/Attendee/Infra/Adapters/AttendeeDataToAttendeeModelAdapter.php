<?php

namespace App\Attendee\Infra\Adapters;

use App\Attendee\Domain\Attendee;

class AttendeeDataToAttendeeModelAdapter
{
    public function toAttendeeModel(Attendee $attendee): AttendeeModel
    {
        return new AttendeeModel([
            'id' => $attendee->getId(),
            'name' => $attendee->getName(),
            'email' => $attendee->getEmail(),
        ]);
    }
}