<?php

namespace App\Notifications\Infra;

use App\Notifications\Domain\NotificationsRepository;
use Illuminate\Database\Eloquent\Collection;

class NotificationsRepositoryModel implements NotificationsRepository
{
    public function __construct(
        protected NotificationsModel $model
    ){
        $this->model = $model;
    }

    public function getAll(): collection
    {
        return $this->model->all();
    }
    
    public function getOne(int $id): NotificationsModel
    {
        return $this->model->find($id);
    }

    public function create(array $data): NotificationsModel
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id): NotificationsModel
    {
        $notification = $this->model->find($id);
        $notification->update($data);
        return $notification;
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }
}