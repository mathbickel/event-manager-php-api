<?php

namespace App\Attendee\Domain;

abstract class AttendeeData
{
    protected int $id;
    protected int $ticket_id;
    protected string $name;
    protected string $email;
    protected string $phone_number;

    public function __construct(int $id,  int $ticket_id,string $name, string $email, string $phone_number)
    {
        $this->id = $id;
        $this->ticket_id = $ticket_id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    abstract public function toArray(): array;
    abstract public function toString(): string;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTicketId(): int
    {
        return $this->ticket_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTicketId(int $ticket_id): void
    {
        $this->ticket_id = $ticket_id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }
}