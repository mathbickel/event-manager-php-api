<?php

namespace App\Notifications\Infra;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\Domain\NotificationsRepository;
use Illuminate\Database\Eloquent\Collection;

class NotificationsRepositoryModel extends NotificationsRepository
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
    
    public function find(int $id): ?NotificationsModel
    {
        return $this->model->find($id);
    }

    public function create(array $data): NotificationsModel
    {
        return $this->model->create($data);
    }

    public function update(NotificationsModel $notification, array $data): NotificationsModel
    {
        $notification->update($data);
        return $notification;
    }

    public function delete(NotificationsModel $notification): void
    {
        $notification->delete();
    }

}