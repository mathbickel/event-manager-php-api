<?php

namespace App\Schedule\Implementation;

use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Common\Helpers\Helper;
use App\Schedule\Domain\Schedule;
use App\Schedule\Domain\ScheduleService;
use Illuminate\Database\Eloquent\Collection;
use App\Schedule\Infra\Adapters\ScheduleModelToScheduleDataAdapter;
use App\Schedule\Infra\ScheduleModel;
use App\Common\Error\Error;
use Exception;

class ScheduleServiceImpl implements ScheduleService
{
    public function __construct(
        private GetAllCommand $getAllCommand,
        private GetOneCommand $getOneCommand,
        private CreateCommand $createCommand,
        private UpdateCommand $updateCommand,
        private DeleteCommand $deleteCommand
    ) {}

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
     * @throws Exception
     */
    public function getOne(int $id): ?Schedule
    {
        $this->ifNotExists($id);
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
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        $adapter = ScheduleModelToScheduleDataAdapter::getInstance($model);
        return $adapter->toScheduleData();
    }

    /**
     * @param int $id
     * @param array $data
     * @return Schedule
     * @throws Exception
     */
    public function update(array $data, int $id): ?Schedule
    {
        $this->ifNotExists($id);
        $this->validateEdit($data);
        $model = $this->updateCommand->execute($data, $id);
        $adapter = ScheduleModelToScheduleDataAdapter::getInstance($model);
        return $adapter->toScheduleData();
    }

    /**
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $this->ifNotExists($id);
        $this->deleteCommand->execute($id);
    }

    private function validate(array $data)
    {
        Helper::validate($data, ScheduleModel::$rules);
    }

    private function validateEdit(array $data)
    {
        Helper::validateEdit($data, ScheduleModel::$rules);
    }

    private function ifNotExists(int $id)
    {
        if(!$this->getOneCommand->execute($id)) return Error::handle('Resource not found', ['schedule_id' => $id]);
    }
}