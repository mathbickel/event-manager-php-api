<?php

namespace App\Event\Domain;

use App\Common\Creator;
use App\Common\Deleter;
use App\Common\Getter;
use App\Common\Updater;

interface EventService extends Getter, Creator, Updater, Deleter
{

}