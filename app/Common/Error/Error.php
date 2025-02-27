<?php

namespace App\Common\Error;
use Illuminate\Support\Facades\Facade;

class Error extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'error';
    }
}