<?php

namespace App\Event\Domain;

use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Event\Infra\EventModel;

interface EventRepository extends BaseRepository
{
    /**
    * @return Collection
    */
    public function getAll(): Collection;

    /**
    * @param int $id
    * @return Event
    */
    public function find(int $id): EventModel;

    /**
    * @param array $data
    * @return Event
    */
    public function create(array $data): EventModel;

    /**
    * @param array $data
    * @param int $id
    * @return Event
    */
    public function update(array $data, int $id): EventModel;

    /**
    * @param int $id
    * @return bool
    */
    public function delete(int $id): bool;
}