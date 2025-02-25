<?php

namespace App\Attendee\Domain;

use App\Common\Creator;
use App\Common\Deleter;
use App\Common\Getter;
use App\Common\Updater;
use Illuminate\Database\Eloquent\Collection;
use App\Attendee\Infra\AttendeeModel;

interface AttendeeRepository extends Getter, Creator, Updater, Deleter
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return AttendeeModel
     */
    public function getOne(int $id): AttendeeModel;

    /**
     * @param array $data
     * @return AttendeeModel
     */
    public function create(array $data): AttendeeModel;

    /** 
     * @param int $id
     * @param array $data
     * @return AttendeeModel
     */
    
    public function update(array $data, int $id): AttendeeModel;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}