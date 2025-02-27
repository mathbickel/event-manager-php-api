<?php

namespace App\Organizer\Domain;

use App\Common\Getter;
use App\Common\Creator;
use App\Common\Updater;
use App\Common\Deleter;
interface OrganizerRepository extends Getter, Creator, Updater, Deleter
{
   
}