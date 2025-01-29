<?php

namespace App\Attendee\Domain;

use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
interface AttendeeRepository extends BaseRepository
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
     * @param array $attendeeData
     * @return Attendee
     */
    public function create(array $attendeeData): Attendee;

    /** 
     * @param int $id
     * @param array $attendeeData
     * @return Attendee
     */
    
    public function update(array $attendeeData, int $id): Attendee;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}