<?php

namespace App\Ticket\Domain;

use App\Service\BaseService;

interface TicketService extends BaseService
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Ticket
     */
    public function getOne(int $id): Ticket;

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