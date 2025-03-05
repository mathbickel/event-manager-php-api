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
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'port' => env('REDIS_PORT', 6379),
                'database' => env('REDIS_DB', 0),
                'password' => env('REDIS_PASSWORD', null),
            ];

            $redisClient = new Client($redisConfig);
            return new CacheClient($redisClient);
        });

        $this->app->bind(CacheRepository::class, CacheRedisRepository::class);
        $this->app->bind(CacheRepository::class, function ($app) {
            return new CacheRepository($app->make(CacheRedisRepository::class));
        });
    }
}