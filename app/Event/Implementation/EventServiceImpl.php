<?php

namespace App\Event\Implementation;

use App\Event\Domain\Event;
use App\Event\Domain\EventRepository;
use App\Event\Domain\EventService;
use App\Event\Infra\Adapters\EventModelToEventDataAdapter;
use Illuminate\Database\Eloquent\Collection;

class EventServiceImpl implements EventService
{
    public function __construct(
        private EventRepository $eventRepository
    ) {
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->eventRepository->getAll();
    }

    /**
     * @param int $id
     * @return Event
     */
    public function getOne(int $id): Event
    {
        return $this->eventRepository->find($id);
    }

    /**
     * @param array $data
     * @return Event
     */
    public function create(array $data): Event
    {
        $model = $this->eventRepository->create($data);
        $adapter = EventModelToEventDataAdapter::getInstance($model);
        return $adapter->toEventModel();
    }

    /**
     * @param array $data
     * @param int $id
     * @return Event
     */
    public function update(array $data, int $id): Event
    {
        return $this->eventRepository->update($data, $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->eventRepository->delete($id);
    }
}

