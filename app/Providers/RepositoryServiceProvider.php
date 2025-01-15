<?php

namespace App\Providers;

use App\Organizer\Domain\OrganizerRepository;
use App\Organizer\Infra\OrganizerRepositoryModel;
use Illuminate\Support\ServiceProvider;
class ImplementationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(OrganizerRepository::class, OrganizerRepositoryModel::class);
    }
}