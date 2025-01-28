<?php

namespace App\Schedule\Domain;

use App\Service\BaseService;
use Illuminate\Database\Eloquent\Collection;
use App\Schedule\Domain\Schedule;

interface ScheduleService extends BaseService
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Schedule
     */
    public function getOne(int $id): Schedule;

    /**
     * @param array $data
     * @return Schedule
     */
    public function create(array $data): Schedule;

    /**
     * @param array $data
     * @param int $id
     * @return Schedule
     */
    public function update(array $data, int $id): Schedule;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}