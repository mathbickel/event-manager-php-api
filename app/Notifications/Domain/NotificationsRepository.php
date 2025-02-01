<?php

namespace App\Notifications\Domain;

use App\Repository\Creator;
use App\Repository\Deleter;
use App\Repository\Getter;
use App\Repository\Updater;
use Illuminate\Database\Eloquent\Collection;

interface NotificationsRepository extends Getter, Creator, Updater, Deleter
{
    /**
     * @return collection
     */
    public function getAll():collection;

    /**
     * @param int $id
     * @return Notifications
     */
    public function find(int $id):Notifications;

    /**
     * @param array $data
     * @return Notifications
     */
    public function create(array $data):Notifications;

    /**
     * @param array $data
     * @param int $id
     * @return Notifications
     */
    public function update(array $data, int $id):Notifications;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}