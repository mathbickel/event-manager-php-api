<?php

namespace App\Providers;

use App\Organizer\Domain\OrganizerService;
use App\Organizer\Implementation\OrganizerServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\Event\Domain\EventService;
use App\Event\Implementation\EventServiceImpl;
class ImplementationServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
    }
}