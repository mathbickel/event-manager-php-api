<?php

namespace App\Ticket\Infra;

use App\Ticket\Domain\TicketRepository;
use App\Ticket\Infra\TicketModel;
use Illuminate\Database\Eloquent\Collection;

class TicketRepositoryModel implements TicketRepository
{
    public function __construct(
        private TicketModel $ticket
    ) {}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->ticket->all();
    }

    /**
     * @param int $id
     * @return TicketModel
     */
    public function getOne(int $id): ?TicketModel
    {
        return $this->ticket->find($id);
    }

    /**
     * @param array $data
     * @return TicketModel
     */
    public function create(array $data): TicketModel
    {
        return $this->ticket->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return ?TicketModel
     */
    public function update(array $data, int $id): ?TicketModel
    {
        $this->ticket->find($id)->update($data);
        return $this->ticket->find($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->ticket->find($id)->delete();
    }
}