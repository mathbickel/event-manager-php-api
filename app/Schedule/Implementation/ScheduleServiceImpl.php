<?php

namespace App\Schedule\Implementation;

use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Schedule\Domain\Schedule;
use App\Schedule\Domain\ScheduleService;
use Illuminate\Database\Eloquent\Collection;
use App\Schedule\Infra\Adapters\ScheduleModelToScheduleDataAdapter;

class ScheduleServiceImpl implements ScheduleService
{
    public function __construct(
        private GetAllCommand $getAllCommand,
        private GetOneCommand $getOneCommand,
        private CreateCommand $createCommand,
        private UpdateCommand $updateCommand,
        private DeleteCommand $deleteCommand
    ){}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->getAllCommand->execute();
    }

    /**
     * @param int $id
     * @return Schedule
     */
    public function getOne(int $id): Schedule
    {
        $model = $this->getOneCommand->execute($id);
        $adapter = ScheduleModelToScheduleDataAdapter::getInstance($model);
        return $adapter->toScheduleData();
    }

    /**
     * @param array $data
     * @return Schedule
     */
    public function create(array $data): Schedule
    {
        $model = $this->createCommand->execute($data);
        $adapter = ScheduleModelToScheduleDataAdapter::getInstance($model);
        return $adapter->toScheduleData();
    }

    /**
     * @param int $id
     * @param array $data
     * @return Schedule
     */
    public function update(array $data, int $id): Schedule
    {
        $model = $this->updateCommand->execute($data, $id);
        $adapter = ScheduleModelToScheduleDataAdapter::getInstance($model);
        return $adapter->toScheduleData();
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): bool
    {
        return $this->deleteCommand->execute($id);
    }
}