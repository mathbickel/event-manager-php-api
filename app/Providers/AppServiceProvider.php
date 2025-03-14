<?php

namespace App\Providers;

use App\Common\Error\ErrorService;
use App\Common\Cache\CacheService;
use App\Common\Cache\CacheRepository;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('error', function () {
            return new ErrorService();
        });
        
        $this->app->bind('cache', function () {
            return new CacheService(
                $this->app->make(CacheRepository::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
