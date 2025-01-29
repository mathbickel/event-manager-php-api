<?php

namespace App\Notifications\Domain;

use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

interface NotificationsRepository extends BaseRepository
{
    /**
     * @return collection[]
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
     * @return void
     */
    public function delete(int $id):bool;
}