<?php

namespace App\Ticket\Implementation;

use App\Ticket\Domain\Ticket;
use App\Ticket\Domain\TicketRepository;
use App\Ticket\Domain\TicketService;
use Illuminate\Database\Eloquent\Collection;

class TicketServiceImpl implements TicketService
{
    public function __construct(
        private TicketRepository $ticketRepository
    ){
        $this->ticketRepository = $ticketRepository;
    }

    public function getAll(): Collection
    {
        return $this->ticketRepository->getAll();
    }

    public function getOne(int $id): Ticket
    {
        return $this->ticketRepository->find($id);
    }

    public function create(array $data): Ticket
    {
        return $this->ticketRepository->create($data);
    }

    public function update(array $data, int $id): Ticket
    {
        return $this->ticketRepository->update($data, $id);
    }

    public function delete(int $id): bool
    {
        return $this->ticketRepository->delete($id);
    }
}