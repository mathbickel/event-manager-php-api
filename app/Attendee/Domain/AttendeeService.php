<?php

namespace App\Attendee\Domain;

use App\Service\BaseService;
use Illuminate\Database\Eloquent\Collection;
use App\Attendee\Domain\Attendee;

interface AttendeeService extends BaseService
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Attendee
     */
    public function getOne(int $id): Attendee;

    /**
     * @param AttendeeData $attendeeData
     * @return Attendee
     */

    public function create(array $attendeeData): Attendee;

    /**
     * @param int $id
     * @param AttendeeData $attendeeData
     * @return Attendee
     */
    public function update(array $attendeeData, int $id): Attendee;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

}