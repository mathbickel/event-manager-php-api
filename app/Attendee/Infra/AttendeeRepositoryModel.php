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

    /**
     * @return Collection
     */  
    public function getAll(): Collection
    {
        return $this->attendee->all();
    }

    /**
     * @param int $id
     * @return ?AttendeeModel
     */
    public function getOne(int $id): ?AttendeeModel
    {
        return $this->attendee->find($id);
    }

    /**
     * @param array $data
     * @return AttendeeModel
     */
    public function create(array $data): AttendeeModel
    {
        return $this->attendee->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return ?AttendeeModel
     */
    public function update(array $data, int $id): ?AttendeeModel
    {
        $attendee = $this->attendee->find($id);
        $attendee->update($data);
        return $attendee;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->attendee->destroy($id);
    }
}