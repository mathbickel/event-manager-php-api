<?php

namespace App\Schedule\Implementation;

use App\Schedule\Domain\ScheduleData;
use App\Schedule\Domain\ScheduleRepository;
use App\Schedule\Domain\ScheduleService;
use Illuminate\Database\Eloquent\Collection;

class ScheduleServiceImpl implements ScheduleService
{
    public function __construct(
        private ScheduleRepository $scheduleRepository
    ){
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->scheduleRepository->getAll();
    }

    /**
     * @param int $id
     * @return Schedule
     */
    public function getOne(int $id): Schedule
    {
        return $this->scheduleRepository->find($id);
    }

    /**
     * @param array $data
     * @return Schedule
     */
    public function create(array $data): Schedule
    {
        return $this->scheduleRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Schedule
     */
    public function update(int $id, array $data): Schedule
    {
        return $this->scheduleRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->scheduleRepository->delete($id);
    }
}