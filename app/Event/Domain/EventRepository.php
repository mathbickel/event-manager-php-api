<?php

namespace App\Event\Domain;

use App\Common\Getter;
use App\Common\Creator;
use App\Common\Updater;
use App\Common\Deleter;

interface EventRepository extends Getter, Creator, Updater, Deleter
{

}