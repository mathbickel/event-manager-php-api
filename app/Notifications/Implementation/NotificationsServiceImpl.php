<?php

namespace App\Notifications\Implementation;

use App\Notifications\Domain\Notifications;
use App\Notifications\Domain\NotificationsRepository;
use App\Notifications\Domain\NotificationsService;
use Illuminate\Database\Eloquent\Collection;

class NotificationsServiceImpl implements NotificationsService
{
    public function __construct(
        private NotificationsRepository $notificationsRepository
    ){}

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
        return $this->notificationsRepository->find($id);
    }

    /**
     * @param array $data
     * @return Notifications
     */
    public function create(array $data): Notifications
    {
        return $this->notificationsRepository->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Notifications
     */
    public function update(array $data, int $id): Notifications
    {
        return $this->notificationsRepository->update($data, $id);
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