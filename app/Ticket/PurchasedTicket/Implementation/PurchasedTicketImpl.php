<?php

namespace App\Ticket\PurchasedTicket\Implementation;

use App\Ticket\PurchasedTicket\Domain\PurchasedTicketService;

class PurchasedTicketImpl implements PurchasedTicketService
{
    private $purchasedTicketRepository;

    public function __construct($purchasedTicketRepository)
    {
        $this->purchasedTicketRepository = $purchasedTicketRepository;
    }

    /**
     * @return PurchasedTicket[]
     */
    public function getAll(): array
    {
        return $this->purchasedTicketRepository->getAll();
    }
    /**
     * @param int $id
     * @return PurchasedTicket
     */
    public function getOne(int $id): PurchasedTicket
    {
        return $this->purchasedTicketRepository->getOne($id);
    }
    /**
     * @param array $data
     * @return PurchasedTicket
     */
    public function create(array $data): PurchasedTicket
    {
        return $this->purchasedTicketRepository->create($data);
    }
    /**
     * @param int $id
     * @param array $data
     * @return PurchasedTicket
     */
    public function update(int $id, array $data): PurchasedTicket
    {
        return $this->purchasedTicketRepository->update($id, $data);
    }
    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->purchasedTicketRepository->delete($id);
    }
    /**
     * @param int $id
     * @return PurchasedTicket
     */
    public function getPurchasedTicket(int $id): PurchasedTicket
    {
        return $this->purchasedTicketRepository->getPurchasedTicket($id);
    }
    /**
     * @param int $id
     * @return PurchasedTicket
     */
    public function getPurchasedTicketByTicketId(int $id): PurchasedTicket
    {
        return $this->purchasedTicketRepository->getPurchasedTicketByTicketId($id);
    }
}