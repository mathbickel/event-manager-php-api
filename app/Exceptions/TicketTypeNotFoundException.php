<?php

namespace App\Exceptions;

class TicketTypeNotFoundException extends BaseException
{
    public function __construct(
        string $message = 'Ticket type not found', 
        array $data = []
    ){
        parent::__construct($message, 404, $data);
    }
}