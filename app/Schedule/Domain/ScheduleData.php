<?php

namespace App\Schedule\Domain;

abstract class ScheduleData
{
    protected int $id;
    protected int $eventId;
    protected string $title;
    protected string $start_date;
    protected string $end_date;

    public function __construct(int $id, int $eventId, string $title, string $start_date, string $end_date)
    {
        $this->id = $id;
        $this->eventId = $eventId;
        $this->title = $title;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    abstract public function toArray(): array;
    abstract public function toString(): string;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEventId(): int
    {
        return $this->eventId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStartDate(): string
    {
        return $this->start_date;
    }

    public function getEndDate(): string
    {
        return $this->end_date;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setEventId(int $eventId): void
    {
        $this->eventId = $eventId;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setStartDate(string $start_date): void
    {
        $this->start_date = $start_date;
    }

    public function setEndDate(string $end_date): void
    {
        $this->end_date = $end_date;
    }
}