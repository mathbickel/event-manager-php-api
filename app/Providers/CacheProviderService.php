<?php

namespace App\Providers;

use App\Common\Cache\Client\CacheClient;
use Illuminate\Support\ServiceProvider;
use Predis\Client;
use App\Common\Cache\Redis\CacheRedisRepository;
use App\Common\Cache\CacheRepository;

class CacheProviderService extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CacheClient::class, function ($app) {
            $redisConfig = [
                'host' => env('REDIS_HOST'),
                'port' => env('REDIS_PORT'),
                'database' => env('REDIS_DB'),
                'password' => env('REDIS_PASSWORD'),
            ];

            $redisClient = new Client($redisConfig);
            return new CacheClient($redisClient);
        });

        $this->app->bind(CacheRepository::class, CacheRedisRepository::class);
    }
}