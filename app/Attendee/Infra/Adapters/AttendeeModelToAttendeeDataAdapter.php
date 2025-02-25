<?php

namespace App\Attendee\Infra\Adapters;

use App\Attendee\Domain\Attendee;
use App\Attendee\Infra\AttendeeModel;

class AttendeeModelToAttendeeDataAdapter
{
    public function __construct(
        private AttendeeModel $attendee
    ) {}

    public static function getInstance(AttendeeModel $attendee): self
    {
        return new AttendeeModelToAttendeeDataAdapter($attendee);
    }

    public function toAttendee(): Attendee
    {
        return new Attendee(
            $this->attendee->id,
            $this->attendee->ticket_id,
            $this->attendee->name,
            $this->attendee->email,
            $this->attendee->phone_number
        );
    }
}

