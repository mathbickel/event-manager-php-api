<?php

namespace App\Attendee\Implementation;

use App\Attendee\Domain\Attendee;
use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Attendee\Domain\AttendeeService;
use App\Attendee\Infra\Adapters\AttendeeModelToAttendeeDataAdapter;
use App\Attendee\Infra\AttendeeModel;
use Illuminate\Database\Eloquent\Collection;
use App\Common\Helpers\Helper;
use App\Common\Error\Error;
use Exception;

class AttendeeServiceImpl implements AttendeeService
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
     * @return Attendee
     * @throws Exception
     */
    public function getOne(int $id): Attendee
    {
        $this->ifNotExists($id);
        $model = $this->getOneCommand->execute($id);
        $adapter = AttendeeModelToAttendeeDataAdapter::getInstance($model);
        return $adapter->toAttendee();
    }

    /**
     * @param array $data
     * @return Attendee
     */
    public function create(array $data): Attendee
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        $adapter = AttendeeModelToAttendeeDataAdapter::getInstance($model);
        return $adapter->toAttendee();
    }

    /**
     * @param array $data
     * @param int $id
     * @return Attendee
     * @throws Exception
     */
    public function update(array $data, int $id): Attendee
    {
        $this->validateEdit($data);
        $this->ifNotExists($id);
        $model = $this->updateCommand->execute($data, $id);
        $adapter = AttendeeModelToAttendeeDataAdapter::getInstance($model);
        return $adapter->toAttendee();
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
        Helper::validate($data, AttendeeModel::$rules);
    }

    private function validateEdit(array $data)
    {
        Helper::validateEdit($data, AttendeeModel::$rules);
    }

    private function ifNotExists(int $id)
    {
        if(!$this->getOneCommand->execute($id)) return Error::handle('Resource not found', ['attendee_id' => $id]);
    }

}