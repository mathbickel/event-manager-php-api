<?php

namespace App\Event\Domain;

use App\Common\Getter;
use App\Common\Creator;
use App\Common\Updater;
use App\Common\Deleter;
use Illuminate\Database\Eloquent\Collection;
use App\Event\Infra\EventModel;

interface EventRepository extends Getter, Creator, Updater, Deleter
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