<?php

namespace App\Event\Infra\Adapters;

use App\Event\Domain\Event;
use App\Event\Infra\EventModel;

class EventModelToEventDataAdapter
{
    public function __construct(
        protected Event $event
        ){
            $this->event = $event;
        }
    public static function getInstance(Event $event): self
    {
        return new EventModelToEventDataAdapter($event);
    }

    public function toEventData(Event $event): Event
    {
        return new Event(
            $event->getId(),
            $event->getName(),
            $event->getDescription(),
            $event->getStartDate(),
            $event->getEndDate(),
            $event->getAddress(),
            $event->getOrganizerId()
        );
    }
}