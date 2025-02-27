<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;
use App\Exceptions\NotFoundException;
class ExceptionFactory
{
    /**
     * @param string $message
     * @param array $data
     * @return BaseException|NotFoundException
     */
    public static function create(string $message, array $data = [])
    {
        switch($message)
        {
            case 'Resource not found':
                return new NotFoundException($message, $data);
            default:
                return new BaseException(500, $data);
        }
    }
}