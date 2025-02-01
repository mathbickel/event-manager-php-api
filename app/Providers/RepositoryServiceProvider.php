<?php

namespace App\Providers;

use App\Common\Commands\GetAllCommand;
use App\Common\Creator;
use App\Common\Getter;
use App\Common\Updater;
use App\Common\Deleter;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Event\Domain\EventRepository;
use App\Event\Domain\EventService;
use App\Organizer\Domain\OrganizerService;
use App\Organizer\Domain\OrganizerRepository;
use Illuminate\Support\ServiceProvider;
class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Getter::class, EventRepository::class);
        $this->app->bind(Creator::class, EventRepository::class);
        $this->app->bind(Updater::class, EventRepository::class);
        $this->app->bind(Deleter::class, EventRepository::class);
        $this->app->bind(Getter::class, OrganizerRepository::class);
        $this->app->bind(Creator::class, OrganizerRepository::class);
        $this->app->bind(Updater::class, OrganizerRepository::class);
        $this->app->bind(Deleter::class, OrganizerRepository::class);

        $this->app->bind(GetAllCommand::class, function ($app) {
            return new GetAllCommand($app->make(Getter::class));
        });

        $this->app->bind(GetOneCommand::class, function ($app) {
            return new GetOneCommand($app->make(Getter::class));
        });
        $this->app->bind(CreateCommand::class, function ($app) {
            return new CreateCommand($app->make(Creator::class));
        });
        $this->app->bind(UpdateCommand::class, function ($app) {
            return new UpdateCommand($app->make(Updater::class));
        });
        $this->app->bind(DeleteCommand::class, function ($app) {
            return new DeleteCommand($app->make(Deleter::class));
        });

        $this->app->bind(EventService::class, function ($app) {
            return new EventService(
                $app->make(GetAllCommand::class),
                $app->make(GetOneCommand::class),
                $app->make(CreateCommand::class),
                $app->make(UpdateCommand::class),
                $app->make(DeleteCommand::class)
            );
        });

        $this->app->bind(OrganizerService::class, function ($app) {
            return new OrganizerService(
                $app->make(GetAllCommand::class),
                $app->make(GetOneCommand::class),
                $app->make(CreateCommand::class),
                $app->make(UpdateCommand::class),
                $app->make(DeleteCommand::class)
            );
        });

    }
}