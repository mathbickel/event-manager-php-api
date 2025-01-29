<?php

namespace App\Notifications\Implementation;

use App\Notifications\Domain\Notifications;
use App\Notifications\Domain\NotificationsData;
use App\Notifications\Domain\NotificationsRepository;
use App\Notifications\Domain\NotificationsService;

class NotificationsServiceImpl implements NotificationsService
{
    public function __construct(
        private NotificationsRepository $notificationsRepository
    ) {
        $this->notificationsRepository = $notificationsRepository;
    }

    public function getAll(): collection;
    {
        return $this->notificationsRepository->getAll();
    }

    public function getOne(int $id): Notifications;
    {
        return $this->notificationsRepository->find($id);
    }

    public function create(array $data): Notifications;
    {
        return $this->notificationsRepository->create($data);
    }

    public function update(array $data, int $id): Notifications;
    {
        return $this->notificationsRepository->update($data, $id);
    }

    public function delete(int $id): bool;
    {
        return $this->notificationsRepository->delete($id);
    }

}