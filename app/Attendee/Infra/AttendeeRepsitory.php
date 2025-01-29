<?php

namespace App\Ateendee\Infra;

use App\Attendee\Domain\Attendee;
use Illuminate\Database\Eloquent\Collection;

class AttendeeRepository implements AttendeeRepository
{
    public function __construct(
        protected AttendeeModel $attendee
        ){
        $this->attendee = $attendee;
    }

    public function getAll(): Collection
    {
        return $this->attendee->all();
    }

    public function getOne(int $id): Attendee
    {
        return $this->attendee->find($id);
    }

    public function create(array $attendeeData): Attendee
    {
        return $this->attendee->create($attendeeData);
    }

    public function update(array $attendeeData, int $id): Attendee
    {
        $attendee = $this->attendee->find($id);
        $attendee->update($attendeeData);
        return $attendee;
    }

    public function delete(int $id): bool
    {
        return $this->attendee->destroy($id);
    }
}