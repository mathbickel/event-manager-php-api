<?php

namespace App\Ticket\Domain;

use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

interface TicketRepository extends BaseRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Ticket
     */
    public function find(int $id): Ticket;

    /**
     * @param array $data
     * @return Ticket
     */
    public function create(array $data): Ticket;

    /**
     * @param array $data
     * @param int $id
     * @return Ticket
     */
    public function update(array $data, int $id): Ticket;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}