<?php

namespace App\Organizer\Implementation;

use App\Organizer\Domain\Organizer;
use App\Organizer\Domain\OrganizerService;
use Illuminate\Database\Eloquent\Collection;
use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;

class OrganizerServiceImpl implements OrganizerService
{
    public function __construct(
        private GetAllCommand $getAllCommand,
        private GetOneCommand $getOneCommand,
        private CreateCommand $createCommand,
        private UpdateCommand $updateCommand,
        private DeleteCommand $deleteCommands
    ){}

    public function getAll(): Collection
    {
        return $this->getAllCommand->execute();
    }

    public function getOne(int $id): Organizer
    {
        return $this->getOneCommand->execute($id);
    }

    public function create(array $data): Organizer
    {
        return $this->createCommand->execute($data);
    }

    public function update(array $data, int $id): Organizer
    {
        return $this->updateCommand->execute($data, $id);
    }

    public function delete(int $id): bool
    {
        return $this->deleteCommands->execute($id);
    }
}