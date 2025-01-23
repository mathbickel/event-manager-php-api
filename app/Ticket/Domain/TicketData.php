<?php

namespace App\Ticket\Domain;

abstract class TicketData
{
    protected int $id;
    protected int $eventId;
    protected int $price;
    protected string $type;
    protected string $status;

    public function __construct(int $id, int $eventId, int $price, string $type, string $status)
    {
        $this->id = $id;
        $this->eventId = $eventId;
        $this->price = $price;
        $this->type = $type;
        $this->status = $status;
    }

    abstract protected function toArray(): array;
    abstract protected function toString(): string;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEventId(): int
    {
        return $this->eventId;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setEventId(int $eventId): void
    {
        $this->eventId = $eventId;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}