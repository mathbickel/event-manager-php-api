<?php

namespace App\Event\Implementation;

use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Event\Domain\Event;
use App\Event\Domain\EventRepository;
use App\Event\Domain\EventService;
use Illuminate\Database\Eloquent\Collection;

class EventServiceImpl implements EventService
{
    public function __construct(
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
        return $this->createCommand->execute($data);
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

