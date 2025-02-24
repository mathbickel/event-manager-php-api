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

    public function __construct(int $id, int $organizer_id, string $name, string $description, string $location, string $address)
    {
        $this->id = $id;
        $this->organizer_id = $organizer_id;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->address = $address;

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
}