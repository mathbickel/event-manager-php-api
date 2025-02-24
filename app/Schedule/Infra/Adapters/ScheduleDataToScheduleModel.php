<?php

namespace App\Schedule\Infra\Adapters;

use App\Schedule\Domain\Schedule;
use App\Schedule\Infra\ScheduleModel;

class ScheduleDataToScheduleModelAdapter
{
    public function __construct(
        private Schedule $schedule
    ){
    }

    public function getInstance(Schedule $schedule): self
    {
        return new ScheduleDataToScheduleModelAdapter($schedule);
    }

    public function toScheduleModel(): ScheduleModel
    {
        return new ScheduleModel($this->schedule->toArray());
    }
}