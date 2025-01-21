<?php

namespace App\Event\Infra\Adapters;

use App\Event\Domain\EventData;
use App\Event\Infra\EventModel;
use Illuminate\Database\Eloquent\Model;

class EventDataToEventModelAdapter
{
    public function __construct(
        protected EventData $event
    ){
        $this->event = $event;
    }
    public static function getInstance(EventData $event): self
    {
        return new EventDataToEventModelAdapter($event);
    }

    public function toEventModel(EventData $event): Model
    {
        return new EventModel($event->toArray());
    }
}