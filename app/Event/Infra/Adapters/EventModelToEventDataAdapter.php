<?php

namespace App\Event\Infra\Adapters;

use App\Event\Domain\EventData;
use App\Event\Infra\EventModel;
use Illuminate\Database\Eloquent\Model;

class EventModelToEventDataAdapter
{
    public function __construct(
        protected EventData $event
        ){
            $this->event = $event;
        }
    public static function getInstance(EventData $event): self
    {
        return new EventModelToEventDataAdapter($event);
    }

    public function toEventModel(Model $event): EventModel
    {
        return new EventModel(
            $event->id,
            $event->name,
            $event->description,
            $event->date_start,
            $event->date_end,
            $event->address,
            $event->organizer_id
        );
    }
}