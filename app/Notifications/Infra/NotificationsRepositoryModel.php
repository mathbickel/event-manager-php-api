<?php

namespace App\Notifications\Infra;

use App\Notifications\Domain\NotificationsRepository;
use Illuminate\Database\Eloquent\Collection;

class NotificationsRepositoryModel implements NotificationsRepository
{
    public function __construct(
        protected NotificationsModel $model
    ) {}

    /**
     * @return Collection
     */
    public function getAll(): collection
    {
        return $this->model->all();
    }
    
    /**
     * @param int $id
     * @return ?NotificationsModel
     */
    public function getOne(int $id): ?NotificationsModel
    {
        return $this->model->find($id);
    }

    /**
     * @param array $data
     * @return NotificationsModel
     */
    public function create(array $data): NotificationsModel
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return ?NotificationsModel
     */
    public function update(array $data, $id): ?NotificationsModel
    {
        $notification = $this->model->find($id);
        $notification->update($data);
        return $notification;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->model->destroy($id);
    }
}