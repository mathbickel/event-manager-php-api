<?php

namespace App\Notifications\Domain;

use App\Common\Creator;
use App\Common\Deleter;
use App\Common\Getter;
use App\Common\Updater;

interface NotificationsRepository extends Getter, Creator, Updater, Deleter
{

}