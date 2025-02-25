<?php

namespace App\Attendee\Implementation;

use App\Attendee\Domain\Attendee;
use App\Attendee\Domain\AttendeeRepository;
use App\Attendee\Domain\AttendeeService;
use App\Attendee\Infra\Adapters\AttendeeModelToAttendeeDataAdapter;
use Illuminate\Database\Eloquent\Collection;

class AttendeeServiceImpl implements AttendeeService
{
    public function __construct(
        private AttendeeRepository $attendeeRepository
    ) {}
    public function getAll(): Collection
    {
        return $this->attendeeRepository->getAll();
    }
public function getOne(int $id): Attendee
    {
        $model = $this->attendeeRepository->getOne($id);
        $adapter = AttendeeModelToAttendeeDataAdapter::getInstance($model);
        return $adapter->toAttendee();
    }
    public function create(array $attendeeData): Attendee
    {
        $model = $this->attendeeRepository->create($attendeeData);
        $adapter = AttendeeModelToAttendeeDataAdapter::getInstance($model);
        return $adapter->toAttendee();
    }
    public function update(array $attendeeData, int $id): Attendee
    {
        $model = $this->attendeeRepository->update($attendeeData, $id);
        $adapter = AttendeeModelToAttendeeDataAdapter::getInstance($model);
        return $adapter->toAttendee();
    }
    public function delete(int $id): bool
    {
        return $this->attendeeRepository->delete($id);
    }
}