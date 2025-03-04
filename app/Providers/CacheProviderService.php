<?php

namespace App\Providers;

use App\Common\Cache\Client\CacheClient;
use Illuminate\Support\ServiceProvider;
use Predis\Client;

class CacheProviderService extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CacheClient::class, function ($app) {
            $redisConfig = [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'port' => env('REDIS_PORT', 6379),
                'database' => env('REDIS_DB', 0),
                'password' => env('REDIS_PASSWORD', null),
            ];

            $redisClient = new Client($redisConfig);
            return new CacheClient($redisClient);
        });
    }
}