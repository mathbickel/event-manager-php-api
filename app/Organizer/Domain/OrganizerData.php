<?php

namespace App\Organizer\Domain;
abstract class OrganizerData
{
    protected int $id;
    protected string $name;
    protected string $phone_number;
    protected string $address;
    protected string $email;

    public function __construct(int $id, string $name, string $email, string $phone_number, ?string $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->address = $address ?? null;
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

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }
}