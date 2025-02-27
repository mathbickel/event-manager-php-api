<?php

namespace App\Ticket\Domain;

use App\Common\Creator;
use App\Common\Deleter;
use App\Common\Getter;
use App\Common\Updater;

interface TicketRepository extends Getter, Creator, Updater, Deleter
{

}