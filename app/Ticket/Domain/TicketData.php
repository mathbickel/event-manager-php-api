<?php

namespace App\Ticket\Domain;

abstract class TicketData
{
    protected int $id;
    protected int $event_id;
    protected string $name;
    protected int $price;
    protected int $quantity;
    protected int $available_quantity;
    protected string $type;
    protected string $status;

    public function __construct(int $id, int $event_id, string $name, int $price, int $quantity, int $available_quantity, string $type, string $status)
    {
        $this->id = $id;
        $this->event_id = $event_id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->available_quantity = $available_quantity;
        $this->type = $type;
        $this->status = $status;
    }

    abstract public function toArray(): array;
    abstract public function toString(): string;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEventId(): int
    {
        return $this->event_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getAvailableQuantity(): int
    {
        return $this->available_quantity;
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
        $this->event_id = $eventId;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setAvailableQuantity(int $available_quantity): void
    {
        $this->available_quantity = $available_quantity;
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