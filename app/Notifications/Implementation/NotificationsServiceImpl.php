<?php

namespace App\Notifications\Implementation;

use App\Notifications\Domain\Notifications;
use App\Notifications\Domain\NotificationsRepository;
use App\Notifications\Domain\NotificationsService;
use App\Notifications\Infra\Adapters\NotificationsModelToNotificationsDataAdapter;
use Illuminate\Database\Eloquent\Collection;

class NotificationsServiceImpl implements NotificationsService
{
    public function __construct(
        private NotificationsRepository $notificationsRepository
    ) {}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->notificationsRepository->getAll();
    }

    /**
     * @param int $id
     * @return Notifications
     */
    public function getOne(int $id): Notifications
    {
        $model = $this->notificationsRepository->getOne($id);
        $adapter = NotificationsModelToNotificationsDataAdapter::getInstance($model);
        return $adapter->NotificationsData();
    }

    /**
     * @param array $data
     * @return Notifications
     */
    public function create(array $data): Notifications
    {
        $model = $this->notificationsRepository->create($data);
        $adapter = NotificationsModelToNotificationsDataAdapter::getInstance($model);
        return $adapter->NotificationsData();
    }

    /**
     * @param array $data
     * @param int $id
     * @return Notifications
     */
    public function update(array $data, int $id): Notifications
    {
        $model = $this->notificationsRepository->update($data, $id);
        $adapter = NotificationsModelToNotificationsDataAdapter::getInstance($model);
        return $adapter->NotificationsData();
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): bool
    {
        return $this->notificationsRepository->delete($id);
    }
}