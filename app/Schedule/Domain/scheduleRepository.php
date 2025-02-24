<?php

namespace App\Schedule\Domain;

use App\Common\Getter;
use App\Common\Creator;
use App\Common\Updater;
use App\Common\Deleter;
use App\Schedule\Infra\ScheduleModel;
use Illuminate\Database\Eloquent\Collection;

interface ScheduleRepository extends Getter, Creator, Updater, Deleter
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return ScheduleModel
     */
    public function getOne(int $id): ScheduleModel;

    /**
     * @param array $data
     * @return ScheduleModel
     */
    public function create(array $data): ScheduleModel;

    /**
     * @param array $data
     * @param int $id
     * @return ScheduleModel
     */
    public function update(array $data, int $id): ScheduleModel;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}