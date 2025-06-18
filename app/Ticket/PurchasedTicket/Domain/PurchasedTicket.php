<?php

namespace App\Ticket\PurchasedTicket\Domain;

class PurchasedTicket {
    private int $id;
    private int $ticket_id;
    private string $status;

    public function __construct(int $id, int $ticket_id, string $status)
    {
        $this->id = $id;
        $this->ticket_id = $ticket_id;
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'ticket_id' => $this->getTicketId(),
            'status' => $this->getStatus()
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTicketId(): int
    {
        return $this->ticket_id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTicketId(int $ticket_id): void
    {
        $this->ticket_id = $ticket_id;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

}