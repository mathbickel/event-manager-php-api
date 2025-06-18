<?php

namespace App\Ticket\Domain;

use App\Common\Creator;
use App\Common\Deleter;
use App\Common\Getter;
use App\Common\Updater;
use App\Ticket\Infra\TicketModel;

interface TicketRepository extends Getter, Creator, Updater, Deleter
{
    public function decreaseAvailableQuantity(int $ticketId, int $quantity): TicketModel;
    public function increaseAvailableQuantity(int $ticketId, int $quantity): TicketModel;
}