<?php

namespace App\Notifications\Domain;

use App\Service\Creator;
use App\Service\Deleter;
use App\Service\Getter;
use App\Service\Updater;
use Illuminate\Database\Eloquent\Collection;

interface NotificationsService extends Getter, Creator, Updater, Deleter
{
    /**
     * @return Collection[]
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Notifications
     */
    public function getOne(int $id): Notifications;

    /**
     * @param array $data
     * @return Notifications
     */
    public function create(array $data): Notifications;

    /**
     * @param array $data
     * @param int $id
     * @return Notifications
     */
    public function update(array $data, int $id): Notifications;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): bool;
}