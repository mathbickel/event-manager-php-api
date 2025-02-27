<?php

namespace App\Schedule\Infra;

use App\Schedule\Domain\ScheduleRepository;
use Illuminate\Database\Eloquent\Collection;

class ScheduleRepositoryModel implements ScheduleRepository
{
    public function __construct(
        private ScheduleModel $schedule
    ) {}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return ScheduleModel::all();
    }

    /**
     * @param int $id
     * @return ?ScheduleModel
     */
    public function getOne(int $id): ?ScheduleModel
    {
        return ScheduleModel::find($id);
    }

    /**
     * @param array $data
     * @return ScheduleModel
     */
    public function create(array $data): ScheduleModel
    {
        return ScheduleModel::create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return ?ScheduleModel
     */
    public function update(array $data, int $id): ?ScheduleModel  {
        $this->schedule->find($id)->update($data);
        return $this->schedule->find($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        ScheduleModel::destroy($id);
    }
}