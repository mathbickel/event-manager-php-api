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
use App\Organizer\Infra\Adapters\OrganizerModelToOrganizerDataAdapter;

class OrganizerServiceImpl implements OrganizerService
{
    public function __construct(
        private GetAllCommand $getAllCommand,
        private GetOneCommand $getOneCommand,
        private CreateCommand $createCommand,
        private UpdateCommand $updateCommand,
        private DeleteCommand $deleteCommand
    ){}

    /**
    * @return Organizer[]|Collection
    */
    public function getAll(): Collection
    {
        return $this->getAllCommand->execute();
    }

    public function getOne(int $id): Organizer
    {
        $model = $this->getOneCommand->execute($id);
        $adapter = OrganizerModelToOrganizerDataAdapter::getInstance($model);
        return $adapter->toOrganizerData();
    }

    public function create(array $data): Organizer
    {
        $model = $this->createCommand->execute($data);
        $adapter = OrganizerModelToOrganizerDataAdapter::getInstance($model);
        return $adapter->toOrganizerData();
    }

    public function update(array $data, int $id): Organizer
    {
        $model = $this->updateCommand->execute($data, $id);
        $adapter = OrganizerModelToOrganizerDataAdapter::getInstance($model);
        return $adapter->toOrganizerData();
    }

    public function delete(int $id): bool
    {
        return $this->deleteCommand->execute($id);
    }
}