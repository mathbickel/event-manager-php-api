<?php

namespace App\Exceptions;

use Exception;

class PayoutException extends Exception
{
    public function __construct(
        string $message = "Payout failed",
        int $code = 500
    ){
        parent::__construct($message, $code);
    }
}