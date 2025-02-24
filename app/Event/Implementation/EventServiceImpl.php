<?php

namespace App\Event\Implementation;

use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Event\Domain\Event;
use App\Event\Domain\EventService;
use App\Event\Infra\Adapters\EventModelToEventDataAdapter;
use Illuminate\Database\Eloquent\Collection;
use App\Event\Domain\EventRepository;

class EventServiceImpl implements EventService
{
    public function __construct(
        private EventRepository $eventRepository,
        private GetAllCommand $getAllCommand,
        private GetOneCommand $getOneCommand,
        private CreateCommand $createCommand,
        private UpdateCommand $updateCommand,
        private DeleteCommand $deleteCommands
    ) {   
    }

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
        return $this->getOneCommand->execute($id);
    }

    /**
     * @param array $data
     * @return Event
     */
    public function create(array $data): Event
    {
        $model = $this->eventRepository->create($data);
        $adapter = EventModelToEventDataAdapter::getInstance($model);
        return $adapter->toEventModel();
    }

    /**
     * @param array $data
     * @param int $id
     * @return Event
     */
    public function update(array $data, int $id): Event
    {
        return $this->updateCommand->execute($data, $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->deleteCommands->execute($id);
    }
}

