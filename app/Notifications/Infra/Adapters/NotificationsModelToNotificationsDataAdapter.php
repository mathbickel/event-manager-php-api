<?php

namespace App\Notifications\Infra\Adapters;

use App\Notifications\Domain\Notifications;
use App\Notifications\Infra\NotificationsModel;

class NotificationsModelToNotificationsDataAdapter
{
    public function __construct(
        protected NotificationsModel $model
    ) {}

    public static function getInstance(NotificationsModel $model): self
    {
        return new NotificationsModelToNotificationsDataAdapter($model);
    }

    public function NotificationsData(): Notifications
    {
        return new Notifications(
            $this->model->id,
            $this->model->attendee_id,
            $this->model->message,
            $this->model->status,
            $this->model->created_at,
            $this->model->updated_at
        );
    }
}