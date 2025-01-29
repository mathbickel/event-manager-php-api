<?php

namespace App\Notifications\Infra\Adapters;

use App\Notifications\Domain\Notifications;
use App\Notifications\Infra\NotificationsModel;

class NotificationsModelToNotificationsDataAdapter
{
    public function __construct(
        protected NotificationsModel $model
    ){
        $this->model = $model;   
    }

    public function getInstance(NotificationsModel $model): self
    {
        return new NotificationsModelToNotificationsDataAdapter($model);
    }

    public function NotificationsData(): Notifications
    {
        return new Notifications(
            $this->model->id,
            $this->model->title,
            $this->model->message,
            $this->model->created_at,
            $this->model->updated_at
        );
    }
}