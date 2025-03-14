<?php

namespace App\Common\Cache;

use Illuminate\Support\Facades\Facade;

class Cache extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cache';
    }
}