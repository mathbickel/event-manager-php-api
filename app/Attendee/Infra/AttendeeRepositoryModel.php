<?php

namespace App\Attendee\Infra;

use Illuminate\Database\Eloquent\Collection;
use App\Attendee\Domain\AttendeeRepository;
use App\Attendee\Infra\AttendeeModel;

class AttendeeRepositoryModel implements AttendeeRepository
{
    public function __construct(
        protected AttendeeModel $attendee
    ) {}

    public function getAll(): Collection
    {
        return $this->attendee->all();
    }

    public function getOne(int $id): AttendeeModel
    {
        return $this->attendee->find($id);
    }

    public function create(array $data): AttendeeModel
    {
        return $this->attendee->create($data);
    }

    public function update(array $data, int $id): AttendeeModel
    {
        $attendee = $this->attendee->find($id);
        $attendee->update($data);
        return $attendee;
    }

    public function delete(int $id): bool
    {
        return $this->attendee->destroy($id);
    }
}