<?php

namespace App\Schedule\Domain;

use App\Common\Getter;
use App\Common\Creator;
use App\Common\Updater;
use App\Common\Deleter;

interface ScheduleService extends Getter, Creator, Updater, Deleter
{

}