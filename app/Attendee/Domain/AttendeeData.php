<?php

namespace App\Attendee\Domain;

abstract class AttendeeData
{
    protected int $id;
    protected string $name;
    protected string $email;
    protected int $ticket_id;

    public function __construct(int $id, string $name, string $email, int $ticket_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->ticket_id = $ticket_id;
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTicketId(): int
    {
        return $this->ticket_id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setTicketId(int $ticket_id): void
    {
        $this->ticket_id = $ticket_id;
    }
}