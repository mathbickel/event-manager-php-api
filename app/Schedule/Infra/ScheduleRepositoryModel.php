<?php

namespace App\Schedule\Infra;

use App\Schedule\Domain\Schedule;
use App\Schedule\Domain\ScheduleRepository;
use Illuminate\Database\Eloquent\Collection;

class ScheduleRepositoryModel implements ScheduleRepository
{
    public function __construct(
        private ScheduleModel $schedule
    ){
        $this->schedule = $schedule;
    }
    public function getAll(): Collection
    {
        return ScheduleModel::all();
    }

    public function find(int $id): Schedule
    {
        return ScheduleModel::find($id);
    }

    public function create(array $data): Schedule
    {
        return ScheduleModel::create($data);
    }

    public function update(array $data, int $id): Schedule  {
        $schedule = ScheduleModel::find($id);
        $schedule->update($data);
        return $schedule;
    }

    public function delete(int $id): bool
    {
        return ScheduleModel::destroy($id);
    }
}