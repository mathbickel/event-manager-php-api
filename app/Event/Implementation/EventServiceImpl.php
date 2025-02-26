<?php

namespace App\Event\Implementation;

use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Common\Helpers\Helper;
use App\Event\Domain\Event;
use App\Event\Domain\EventService;
use App\Event\Infra\Adapters\EventModelToEventDataAdapter;
use Illuminate\Database\Eloquent\Collection;
use App\Event\Infra\EventModel;

class EventServiceImpl implements EventService
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
     * @return Event
     */
    public function getOne(int $id): Event
    {
        $model = $this->getOneCommand->execute($id);
        $adapter = EventModelToEventDataAdapter::getInstance($model);
        return $adapter->toEventData();
    }

    /**
     * @param array $data
     * @return Event
     */
    public function create(array $data): Event
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        $adapter = EventModelToEventDataAdapter::getInstance($model);
        return $adapter->toEventData();
    }

    /**
     * @param array $data
     * @param int $id
     * @return Event
     */
    public function update(array $data, int $id): Event
    {
        $this->validate($data);
        $model = $this->updateCommand->execute($data, $id);
        $adapter = EventModelToEventDataAdapter::getInstance($model);
        return $adapter->toEventData();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->deleteCommand->execute($id);
    }

    private function validate(array $data)
    {
        Helper::validate($data, EventModel::$rules);
    }
}

