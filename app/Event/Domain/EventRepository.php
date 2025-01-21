<?php

namespace App\Event\Domain;

use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

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
    public function find(int $id): Event;

    /**
    * @param array $data
    * @return Event
    */
    public function create(array $data): Event;

    /**
    * @param array $data
    * @param int $id
    * @return Event
    */
    public function update(array $data, int $id): Event;

    /**
    * @param int $id
    * @return bool
    */
    public function delete(int $id): bool;
}