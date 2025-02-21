<?php

namespace App\Event\Implementation;

use App\Attendee\Domain\Attendee;
use App\Attendee\Domain\AttendeeRepository;
use App\Attendee\Domain\AttendeeService;
use Illuminate\Database\Eloquent\Collection;

class AttedeeServiceImpl implements AttendeeService
{
    public function __construct(
        private AttendeeRepository $attendeeRepository
        ){
        $this->attendeeRepository = $attendeeRepository;
    }
    public function getAll(): Collection
    {
        return $this->attendeeRepository->getAll();
    }

    public function getOne(int $id): Attendee
    {
        return $this->attendeeRepository->getOne($id);
    }

    public function create(array $attendeeData): Attendee
    {
        return $this->attendeeRepository->create($attendeeData);
    }

    public function update(array $attendeeData, int $id): Attendee
    {
        return $this->attendeeRepository->update($attendeeData, $id);
    }

    public function delete(int $id): bool
    {
        return $this->attendeeRepository->delete($id);
    }

}