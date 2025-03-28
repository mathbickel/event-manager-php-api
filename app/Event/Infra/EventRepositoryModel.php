<?php

namespace App\Event\Infra;

use App\Event\Domain\EventRepository;
use Illuminate\Database\Eloquent\Collection;

class EventRepositoryModel implements EventRepository
{
    public function __construct(
        protected EventModel $event
    ) {}

    /**
     * @return EventModel[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->event->all();
    }

    /**
     * @param int $id
     * @return ?EventModel
     */
    public function getOne(int $id): ?EventModel
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
     * @return ?EventModel
     */
    public function update(array $data, int $id): ?EventModel
    {
        $this->event->find($id)->update($data);
        return $this->event->find($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->event->find($id)->delete();
    }
}