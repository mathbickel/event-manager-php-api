<?php

namespace App\Notifications\Domain;

use App\Common\Creator;
use App\Common\Deleter;
use App\Common\Getter;
use App\Common\Updater;
use App\Notifications\Infra\NotificationsModel;
use Illuminate\Database\Eloquent\Collection;

interface NotificationsRepository extends Getter, Creator, Updater, Deleter
{
    /**
     * @return collection
     */
    public function getAll():collection;

    /**
     * @param int $id
     * @return NotificationsModel
     */
    public function getOne(int $id): NotificationsModel;

    /**
     * @param array $data
     * @return NotificationsModel
     */
    public function create(array $data): NotificationsModel;

    /**
     * @param array $data
     * @param int $id
     * @return NotificationsModel
     */
    public function update(array $data, int $id): NotificationsModel;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}