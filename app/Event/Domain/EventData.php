<?php

namespace App\Event\Domain;

abstract class EventData
{
    protected int $id;
    protected int $organizer_id;
    protected string $name;
    protected string $description;
    protected string $location;
    protected string $address;
    protected string $start_date;
    protected string $end_date;
    protected string $start_time;
    protected string $end_time;

    public function __construct(int $id, int $organizer_id, string $name, string $description, string $location, string $address, string $start_date, string $end_date, string $start_time, string $end_time)
    {
        $this->id = $id;
        $this->organizer_id = $organizer_id;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->address = $address;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->start_time = $start_time;
        $this->end_time = $end_time;

    }

    abstract public function toArray(): array;
    abstract public function toString(): string;
    public function getId(): int
    {
        return $this->id;
    }

    public function getOrganizerId(): int
    {
        return $this->organizer_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getStartDate(): string
    {
        return $this->start_date;
    }

    public function getEndDate(): string
    {
        return $this->end_date;
    }

    public function getStartTime(): string
    {
        return $this->start_time;
    }

    public function getEndTime(): string
    {
        return $this->end_time;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setOrganizerId(int $organizer_id): void
    {
        $this->organizer_id = $organizer_id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function setStartDate(string $start_date): void
    {
        $this->start_date = $start_date;
    }

    public function setEndDate(string $end_date): void
    {
        $this->end_date = $end_date;
    }

    public function setStartTime(string $start_time): void
    {
        $this->start_time = $start_time;
    }

    public function setEndTime(string $end_time): void
    {
        $this->end_time = $end_time;
    }

}