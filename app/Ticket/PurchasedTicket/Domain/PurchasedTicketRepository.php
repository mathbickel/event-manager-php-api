<?php

namespace App\Ticket\PurchasedTicket\Domain;

interface PurchasedTicketRepository
{
    /**
     * @return PurchasedTicket[]
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return PurchasedTicket
     */
    public function getOne(int $id): PurchasedTicket;

    /**
     * @param array $data
     * @return PurchasedTicket
     */
    public function create(array $data): PurchasedTicket;

    /**
     * @param int $id
     * @param array $data
     * @return PurchasedTicket
     */
    public function update(int $id, array $data): PurchasedTicket;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}