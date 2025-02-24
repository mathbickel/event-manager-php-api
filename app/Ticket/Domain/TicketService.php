<?php

namespace App\Ticket\Domain;

use App\Common\Creator;
use App\Common\Deleter;
use App\Common\Getter;
use App\Common\Updater;
use Illuminate\Database\Eloquent\Collection;
use App\Ticket\Domain\Ticket;

interface TicketService extends Getter, Creator, Updater, Deleter
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