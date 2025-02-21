<?php

namespace App\Event\Infra\Adapters;

use App\Event\Domain\EventData;
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

    public function toEventModel(): EventData
    {
        return new EventData(
            $this->event->id,
            $this->event->organizer_id,
            $this->event->name,
            $this->event->description,
            $this->event->date,
            $this->event->location,
            $this->event->start_date,
            $this->event->end_date
        );
    }
}