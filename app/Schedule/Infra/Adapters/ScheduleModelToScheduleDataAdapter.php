<?php

namespace App\Schedule\Infra\Adapters;

use App\Schedule\Infra\ScheduleModel;
use App\Schedule\Domain\Schedule;

class ScheduleModelToScheduleDataAdapter
{
    public function __construct(
        private ScheduleModel $schedule
    ){
    }

    public static function getInstance(ScheduleModel $schedule): self
    {
        return new ScheduleModelToScheduleDataAdapter($schedule);
    }

    public function toScheduleData(): Schedule
    {
        return new Schedule(
            $this->schedule->id,
            $this->schedule->event_id,
            $this->schedule->start_time,
            $this->schedule->end_time,
            $this->schedule->start_date,
            $this->schedule->end_date
        );
    }
}