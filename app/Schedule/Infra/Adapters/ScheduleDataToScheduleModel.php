<?php

namespace App\Schedule\Infra\Adapters;

use App\Schedule\Domain\Schedule;
use App\Schedule\Domain\ScheduleData;
use App\Schedule\Infra\ScheduleModel;

class ScheduleDataToScheduleModel
{
    public function __construct(
        private Schedule $schedule
    ){
        $this->schedule = $schedule;
    }

    public function getInstance(Schedule $schedule): self
    {
        return new ScheduleDataToScheduleModel($schedule);
    }

    public function toScheduleModel(Schedule $schedule): ScheduleModel
    {
        return new ScheduleModel($schedule->toArray());
    }
}