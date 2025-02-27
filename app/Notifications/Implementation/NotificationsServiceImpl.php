<?php

namespace App\Notifications\Implementation;

use App\Notifications\Domain\Notifications;
use App\Notifications\Domain\NotificationsService;
use App\Notifications\Infra\Adapters\NotificationsModelToNotificationsDataAdapter;
use App\Notifications\Infra\NotificationsModel;
use Illuminate\Database\Eloquent\Collection;
use App\Common\Helpers\Helper;
use App\Common\Error\Error;
use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use Exception;


class NotificationsServiceImpl implements NotificationsService
{
    public function __construct(
        private GetAllCommand $getAllCommand,
        private GetOneCommand $getOneCommand,
        private CreateCommand $createCommand,
        private UpdateCommand $updateCommand,
        private DeleteCommand $deleteCommand
    ) {}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->getAllCommand->execute();
    }

    /**
     * @param int $id
     * @return ?Notifications
     * @throws Exception
     */
    public function getOne(int $id): ?Notifications
    {
        $this->ifNotExists($id);
        $model = $this->getOneCommand->execute($id);
        $adapter = NotificationsModelToNotificationsDataAdapter::getInstance($model);
        return $adapter->NotificationsData();
    }

    /**
     * @param array $data
     * @return Notifications
     */
    public function create(array $data): Notifications
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        $adapter = NotificationsModelToNotificationsDataAdapter::getInstance($model);
        return $adapter->NotificationsData();
    }

    /**
     * @param array $data
     * @param int $id
     * @return ?Notifications
     * @throws Exception
     */
    public function update(array $data, int $id): ?Notifications
    {
        $this->ifNotExists($id);
        $this->validateEdit($data);
        $model = $this->updateCommand->execute($data, $id);
        $adapter = NotificationsModelToNotificationsDataAdapter::getInstance($model);
        return $adapter->NotificationsData();
    }

    /**
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $this->ifNotExists($id);
        $this->deleteCommand->execute($id);
    }

    private function validate(array $data)
    {
        Helper::validate($data, NotificationsModel::$rules);
    }

    private function validateEdit(array $data)
    {
        Helper::validateEdit($data, NotificationsModel::$rules);
    }

    private function ifNotExists(int $id)
    {
        if(!$this->getOneCommand->execute($id)) return Error::handle('Resource not found', ['notification_id' => $id]);
    }
}