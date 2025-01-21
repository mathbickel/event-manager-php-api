<?php

namespace App\Event\Infra;

use App\Event\Domain\Event;
use Illuminate\Database\Eloquent\Model;
use App\Event\Domain\EventRepository;

class EventRepositoryModel implements EventRepository
{
    public function __construct(
        protected EventModel $event
    ){
        $this->event = $event;
    }
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->event->all();
    }

    /**
     * @param int $id
     * @return Event
     */
    public function find(int $id): Event
    {
        return $this->event->find($id);
    }

    /**
     * @param array $data
     * @return Event
     */
    public function create(array $data): Event
    {
        return $this->event->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Event
     */
    public function update(array $data, int $id): Event
    {
        return $this->event->find($id)->update($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->event->find($id)->delete();
    }

}