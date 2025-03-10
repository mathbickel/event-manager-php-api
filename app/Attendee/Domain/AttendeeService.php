<?php

namespace App\Attendee\Domain;

use App\Common\Creator;
use App\Common\Deleter;
use App\Common\Getter;
use App\Common\Updater;
interface AttendeeService extends Getter, Creator, Updater, Deleter
{

}