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
use App\Ticket\Infra\TicketModel;
use App\Common\Helpers\Helper;
use App\Common\Error\Error;
use Exception;

class TicketServiceImpl implements TicketService
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
     * @return Ticket
     * @throws Exception
     */
    public function getOne(int $id): Ticket
    {
        $this->ifNotExists($id);
        $model = $this->getOneCommand->execute($id);
        $adapter = TicketModelToTicketDataAdapter::getInstance($model);
        return $adapter->toTicketData();
    }

    /**
     * @param array $data
     * @return Ticket
     */
    public function create(array $data): ?Ticket
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        $adapter = TicketModelToTicketDataAdapter::getInstance($model);
        return $adapter->toTicketData();
    }

    /**
     * @param array $data
     * @param int $id
     * @return Ticket
     * @throws Exception
     */
    public function update(array $data, int $id): ?Ticket
    {
        $this->ifNotExists($id);
        $this->validateEdit($data);
        $model = $this->updateCommand->execute($data, $id);
        $adapter = TicketModelToTicketDataAdapter::getInstance($model);
        return $adapter->toTicketData();
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
        Helper::validate($data, TicketModel::$rules);
    }

    private function validateEdit(array $data)
    {
        Helper::validateEdit($data, TicketModel::$rules);
    }

    private function ifNotExists(int $id)
    {
        if(!$this->getOneCommand->execute($id)) return Error::handle('Resource not found', ['ticket_id' => $id]);
    }
}