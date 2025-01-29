<?php

namespace App\Attendee\Infra;

use App\Attendee\Domain\Attendee;

class AttendeeModelToAttendeeDataAdapter
{
    public function __construct(
        private AttendeeModel $attendee
    ){
        $this->attendee = $attendee;   
    }

    public function getInstance(): self
    {
        return new AttendeeModelToAttendeeDataAdapter($this->attendee);
    }

    public function toAttendee(): Attendee
    {
        return new Attendee(
            $this->attendee->id,
            $this->attendee->name,
            $this->attendee->email
        );
    }

}

