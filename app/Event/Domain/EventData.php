<?php

namespace App\Event\Domain;

abstract class EventData
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected string $start_date;
    protected string $end_date;
    protected string $address;
    protected int $organizer_id;

    public function __construct(int $id, string $name, string $description, string $start_date, string $end_date, string $address, int $organizer_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->address = $address;
        $this->organizer_id = $organizer_id;
    }

    abstract public function toArray(): array;
    abstract public function toString(): string;
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStartDate(): string
    {
        return $this->start_date;
    }

    public function getEndDate(): string
    {
        return $this->end_date;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getOrganizerId(): int
    {
        return $this->organizer_id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setStartDate(string $start_date): void
    {
        $this->start_date = $start_date;
    }

    public function setEndDate(string $end_date): void
    {
        $this->end_date = $end_date;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function setOrganizerId(int $organizer_id): void
    {
        $this->organizer_id = $organizer_id;
    }
}