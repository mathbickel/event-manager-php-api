<?php

namespace App\Schedule\Infra\Adapters;

use App\Schedule\Domain\ScheduleData;
use App\Schedule\Infra\ScheduleModel;

class ScheduleModelToScheduleData
{
    public function __construct(
        private ScheduleModel $schedule
    ){
        $this->schedule = $schedule;    
    }

    public function getInstance(ScheduleModel $schedule): self
    {
        return new ScheduleModelToScheduleData($schedule);
    }

    public function toScheduleData(ScheduleModel $schedule): ScheduleData
    {
        return new ScheduleData(
            $schedule->id,
            $schedule->event_id,
            $schedule->title,
            $schedule->start_date,
            $schedule->end_date
        );
    }
}