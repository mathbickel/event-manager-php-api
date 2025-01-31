<?php

namespace App\Event\Domain;

use App\Service\BaseService;
use Illuminate\Database\Eloquent\Collection;

interface EventService extends BaseService
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