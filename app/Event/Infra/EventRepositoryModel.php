<?php

namespace App\Event\Infra;

use App\Event\Domain\EventRepository;
use Illuminate\Database\Eloquent\Collection;

class EventRepositoryModel implements EventRepository
{
    public function __construct(
        protected EventModel $event
    ){
        $this->event = $event;
    }

    /**
     * @return EventModel[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->event->all();
    }

    /**
     * @param int $id
     * @return EventModel
     */
    public function find(int $id): EventModel
    {
        return $this->event->find($id);
    }

    /**
     * @param array $data
     * @return EventModel
     */
    public function create(array $data): EventModel
    {
        return $this->event->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return EventModel
     */
    public function update(array $data, int $id): EventModel
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