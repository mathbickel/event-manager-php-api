<?php

namespace App\Event\Domain;

use App\Common\Creator;
use App\Common\Deleter;
use App\Common\Getter;
use App\Common\Updater;
use Illuminate\Database\Eloquent\Collection;
use App\Event\Domain\Event;


interface EventService extends Getter, Creator, Updater, Deleter
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Event
     */
    public function getOne(int $id): Event;

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