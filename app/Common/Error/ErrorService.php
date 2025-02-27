<?php

namespace App\Common\Error;

use App\Exceptions\BaseException;
use App\Exceptions\ExceptionFactory;
use App\Exceptions\NotFoundException;

class ErrorService
{
    /**
     * @param string $message
     * @param array $data
     * @return BaseException|NotFoundException
     */
    public function handle(string $message, array $data = [])
    {
        $exception = ExceptionFactory::create($message, $data);
        throw $exception; 
    }
}