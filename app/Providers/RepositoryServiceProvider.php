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
use App\Organizer\Domain\OrganizerService;
use App\Organizer\Domain\OrganizerRepository;
use Illuminate\Support\ServiceProvider;
use App\Organizer\Implementation\OrganizerServiceImpl;
use App\Organizer\Infra\OrganizerRepositoryModel;
use App\Event\Implementation\EventServiceImpl;
use App\Event\Infra\EventRepositoryModel;
use App\Event\Domain\EventService;
use App\Schedule\Domain\ScheduleService;
use App\Schedule\Implementation\ScheduleServiceImpl;
use App\Schedule\Domain\ScheduleRepository;
use App\Schedule\Infra\ScheduleRepositoryModel;
use App\Ticket\Domain\TicketService;
use App\Ticket\Implementation\TicketServiceImpl;
use App\Ticket\Domain\TicketRepository;
use App\Ticket\Infra\TicketRepositoryModel;
use App\Attendee\Domain\AttendeeService;
use App\Attendee\Domain\AttendeeRepository;
use App\Attendee\Implementation\AttendeeServiceImpl;
use App\Attendee\Infra\AttendeeRepositoryModel;
use App\Notifications\Domain\NotificationsService;
use App\Notifications\Implementation\NotificationsServiceImpl;
use App\Notifications\Domain\NotificationsRepository;
use App\Notifications\Infra\NotificationsRepositoryModel;

class RepositoryServiceProvider extends ServiceProvider
{
   public function register()
    {
        //ORGANIZER BINDS
        $this->app->bind(OrganizerService::class, OrganizerServiceImpl::class);
        $this->app->bind(OrganizerRepository::class, OrganizerRepositoryModel::class);

        $this->app->when(OrganizerServiceImpl::class)
            ->needs(Getter::class)
            ->give(OrganizerRepository::class);

        $this->app->when(OrganizerServiceImpl::class)
            ->needs(Creator::class)
            ->give(OrganizerRepository::class);

        $this->app->when(OrganizerServiceImpl::class)
            ->needs(Updater::class)
            ->give(OrganizerRepository::class);

        $this->app->when(OrganizerServiceImpl::class)
            ->needs(Deleter::class)
            ->give(OrganizerRepository::class);

        //EVENT BINDS
        $this->app->bind(EventService::class, EventServiceImpl::class);
        $this->app->bind(EventRepository::class, EventRepositoryModel::class);

        $this->app->when(EventServiceImpl::class)
            ->needs(Getter::class)
            ->give(EventRepository::class);

        $this->app->when(EventServiceImpl::class)
            ->needs(Creator::class)
            ->give(EventRepository::class);

        $this->app->when(EventServiceImpl::class)
            ->needs(Updater::class)
            ->give(EventRepository::class);

        $this->app->when(EventServiceImpl::class)
            ->needs(Deleter::class)
            ->give(EventRepository::class);


        //SCHEDULE BINDS
        $this->app->bind(ScheduleService::class, ScheduleServiceImpl::class);
        $this->app->bind(ScheduleRepository::class, ScheduleRepositoryModel::class);

        $this->app->when(ScheduleServiceImpl::class)
            ->needs(Getter::class)
            ->give(ScheduleRepository::class);

        $this->app->when(ScheduleServiceImpl::class)
            ->needs(Creator::class)
            ->give(ScheduleRepository::class);

        $this->app->when(ScheduleServiceImpl::class)
            ->needs(Updater::class)
            ->give(ScheduleRepository::class);

        $this->app->when(ScheduleServiceImpl::class)
            ->needs(Deleter::class)
            ->give(ScheduleRepository::class);
    

        //TICKET BINDS
        $this->app->bind(TicketService::class, TicketServiceImpl::class);
        $this->app->bind(TicketRepository::class, TicketRepositoryModel::class);

        $this->app->when(TicketServiceImpl::class)
            ->needs(Getter::class)
            ->give(TicketRepository::class);

        $this->app->when(TicketServiceImpl::class)
            ->needs(Creator::class)
            ->give(TicketRepository::class);

        $this->app->when(TicketServiceImpl::class)
            ->needs(Updater::class)
            ->give(TicketRepository::class);

        $this->app->when(TicketServiceImpl::class)
            ->needs(Deleter::class)
            ->give(TicketRepository::class);

        //ATTENDEE BINDS
        $this->app->bind(AttendeeService::class, AttendeeServiceImpl::class);
        $this->app->bind(AttendeeRepository::class, AttendeeRepositoryModel::class);

        $this->app->when(AttendeeServiceImpl::class)
            ->needs(Getter::class)
            ->give(AttendeeRepository::class);

        $this->app->when(AttendeeServiceImpl::class)
            ->needs(Creator::class)
            ->give(AttendeeRepository::class);

        $this->app->when(AttendeeServiceImpl::class)
            ->needs(Updater::class)
            ->give(AttendeeRepository::class);

        $this->app->when(AttendeeServiceImpl::class)
            ->needs(Deleter::class)
            ->give(AttendeeRepository::class);

        //NOTIFICATION BINDS
        $this->app->bind(NotificationsService::class, NotificationsServiceImpl::class);
        $this->app->bind(NotificationsRepository::class, NotificationsRepositoryModel::class);

        $this->app->when(NotificationsServiceImpl::class)
            ->needs(Getter::class)
            ->give(NotificationsRepository::class);

        $this->app->when(NotificationsServiceImpl::class)
            ->needs(Creator::class)
            ->give(NotificationsRepository::class);

        $this->app->when(NotificationsServiceImpl::class)
            ->needs(Updater::class)
            ->give(NotificationsRepository::class);

        $this->app->when(NotificationsServiceImpl::class)
            ->needs(Deleter::class)
            ->give(NotificationsRepository::class);

        //COMMANDS BINDS
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
    }
}