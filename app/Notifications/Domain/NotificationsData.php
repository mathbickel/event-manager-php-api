<?php

namespace App\Notifications\Domain;

abstract class NotificationsData
{
    protected $id;
    protected $attendee_id;
    protected $message;
    protected $status;

    public function __construct(int $id, int $attendee_id, string $message, string $status)
    {
        $this->id = $id;
        $this->attendee_id = $attendee_id;
        $this->message = $message;
        $this->status = $status;
    }

    abstract function toArray(): array;
    abstract function toString(): string;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAttendeeId(): int
    {
        return $this->attendee_id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setAttendeeId(int $attendee_id): void
    {
        $this->attendee_id = $attendee_id;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}