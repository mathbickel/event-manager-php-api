<?php

namespace App\Providers;

use App\Organizer\Domain\OrganizerService;
use App\Organizer\Implementation\OrganizerServiceImpl;
use Illuminate\Support\ServiceProvider;
class ImplementationServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrganizerService::class, OrganizerServiceImpl::class);
    }
}