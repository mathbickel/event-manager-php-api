<?php

namespace App\Event\Infra\Adapters;

use App\Event\Domain\Event;
use App\Event\Infra\EventModel;

class EventModelToEventDataAdapter
{
    public function __construct(
        protected EventModel $event
        ){
            $this->event = $event;
        }
    public static function getInstance(EventModel $event): self
    {
        return new EventModelToEventDataAdapter($event);
    }

    public function toEventData(): Event
    {
        return new Event(
            $this->event->id,
            $this->event->organizer_id,
            $this->event->name,
            $this->event->description,
            $this->event->location,
            $this->event->address,
            $this->event->start_date,
            $this->event->end_date,
            $this->event->start_time,
            $this->event->end_time
        );
    }
}