<?php

namespace App\Notifications\Infra\Adapters;

use App\Notifications\Domain\Notifications;
use App\Notifications\Infra\NotificationsModel;

class NotificationsDataToNotificationsModelAdapter
{
    public function toNotificationsModel(Notifications $notifications): NotificationsModel
    {
        return new NotificationsModel($notifications->toArray());
    }
}