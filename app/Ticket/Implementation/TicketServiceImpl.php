<?php

namespace App\Ticket\Implementation;

use App\Ticket\Domain\Ticket;
use App\Ticket\Domain\TicketService;
use Illuminate\Database\Eloquent\Collection;
use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Ticket\Infra\Adapters\TicketModelToTicketDataAdapter;

class TicketServiceImpl implements TicketService
{
    public function __construct(
        private GetAllCommand $getAllCommand,
        private GetOneCommand $getOneCommand,
        private CreateCommand $createCommand,
        private UpdateCommand $updateCommand,
        private DeleteCommand $deleteCommand
    ){}

    public function getAll(): Collection
    {
        return $this->getAllCommand->execute();
    }

    public function getOne(int $id): Ticket
    {
        $model = $this->getOneCommand->execute($id);
        $adapter = TicketModelToTicketDataAdapter::getInstance($model);
        return $adapter->toTicketData();
    }

    public function create(array $data): Ticket
    {
        $model = $this->createCommand->execute($data);
        $adapter = TicketModelToTicketDataAdapter::getInstance($model);
        return $adapter->toTicketData();
    }

    public function update(array $data, int $id): Ticket
    {
        $model = $this->updateCommand->execute($data, $id);
        $adapter = TicketModelToTicketDataAdapter::getInstance($model);
        return $adapter->toTicketData();
    }

    public function delete(int $id): bool
    {
        return $this->deleteCommand->execute($id);
    }
}