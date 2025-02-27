<?php

namespace App\Event\Implementation;

use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Common\Error\Error;
use App\Common\Helpers\Helper;
use App\Event\Domain\Event;
use App\Event\Domain\EventService;
use App\Event\Infra\Adapters\EventModelToEventDataAdapter;
use Illuminate\Database\Eloquent\Collection;
use App\Event\Infra\EventModel;
use Exception;

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
     * @throws Exception
     */
    public function getOne(int $id): Event
    {
        $this->ifNotExists($id);
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
     * @throws Exception
     */
    public function update(array $data, int $id): Event
    {
        $this->ifNotExists($id);
        $this->validateEdit($data);
        $model = $this->updateCommand->execute($data, $id);
        $adapter = EventModelToEventDataAdapter::getInstance($model);
        return $adapter->toEventData();
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
        Helper::validate($data, EventModel::$rules);
    }

    private function validateEdit(array $data)
    {
        Helper::validateEdit($data, EventModel::$rules);
    }
    
    private function ifNotExists(int $id)
    {
        if(!$this->getOneCommand->execute($id)) return Error::handle('Resource not found', ['event_id' => $id]);
    }
}

