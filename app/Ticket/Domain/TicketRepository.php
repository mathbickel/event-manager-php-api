<?php

namespace App\Ticket\Domain;

use App\Common\Creator;
use App\Common\Deleter;
use App\Common\Getter;
use App\Common\Updater;
use Illuminate\Database\Eloquent\Collection;
use App\Ticket\Infra\TicketModel;

interface TicketRepository extends Getter, Creator, Updater, Deleter
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return TicketModel
     */
    public function getOne(int $id): TicketModel;

    /**
     * @param array $data
     * @return TicketModel
     */
    public function create(array $data): TicketModel;

    /**
     * @param array $data
     * @param int $id
     * @return TicketModel
     */
    public function update(array $data, int $id): TicketModel;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}