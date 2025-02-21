<?php

namespace App\Event\Infra\Adapters;

use App\Event\Domain\Event;
use App\Event\Infra\EventModel;
use Illuminate\Database\Eloquent\Model;

class EventDataToEventModelAdapter
{
    public function __construct(
        protected Event $event
    ){
        $this->event = $event;
    }
    public static function getInstance(Event $event): self
    {
        return new EventDataToEventModelAdapter($event);
    }

    public function toEventModel(Event $event): Model
    {
        return new EventModel($event->toArray());
    }
}