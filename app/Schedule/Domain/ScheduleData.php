<?php

namespace App\Schedule\Domain;

abstract class ScheduleData
{
    protected int $id;
    protected int $event_id;
    protected string $title;
    protected string $start_time;
    protected string $end_time;
    protected string $start_date;
    protected string $end_date;

    public function __construct(int $id, int $event_id, string $title, string $start_time, string $end_time, string $start_date, string $end_date)
    {
        $this->id = $id;
        $this->event_id = $event_id;
        $this->title = $title;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
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
        return $this->event_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStartTime(): string
    {
        return $this->start_time;
    }

    public function getEndTime(): string
    {
        return $this->end_time;
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

    public function setEventId(int $event_id): void
    {
        $this->event_id = $event_id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setStartTime(string $start_time): void
    {
        $this->start_time = $start_time;
    }

    public function setEndTime(string $end_time): void
    {
        $this->end_time = $end_time;
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