<?php

namespace App\Schedule\Domain;

use App\Schedule\Domain\ScheduleData;

class Schedule extends ScheduleData
{
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'event_id' => $this->getEventId(),
            'title' => $this->getTitle(),
            'start_time' => $this->getStartTime(),
            'end_time' => $this->getEndTime(),
            'start_date' => $this->getStartDate(),
            'end_date' => $this->getEndDate(),
        ];
    }

    public function toString(): string
    {
        return json_encode($this->toArray());
    }
} 