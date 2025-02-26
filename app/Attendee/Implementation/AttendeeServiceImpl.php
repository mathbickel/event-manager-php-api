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

class AttendeeServiceImpl implements AttendeeService
{
    public function __construct(
        private GetAllCommand $getAllCommand,
        private GetOneCommand $getOneCommand,
        private CreateCommand $createCommand,
        private UpdateCommand $updateCommand,
        private DeleteCommand $deleteCommand
    ) {}
    public function getAll(): Collection
    {
        return $this->getAllCommand->execute();
    }
public function getOne(int $id): Attendee
    {
        $model = $this->getOneCommand->execute($id);
        $adapter = AttendeeModelToAttendeeDataAdapter::getInstance($model);
        return $adapter->toAttendee();
    }
    public function create(array $data): Attendee
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        $adapter = AttendeeModelToAttendeeDataAdapter::getInstance($model);
        return $adapter->toAttendee();
    }
    public function update(array $data, int $id): Attendee
    {
        $this->validate($data);
        $model = $this->updateCommand->execute($data, $id);
        $adapter = AttendeeModelToAttendeeDataAdapter::getInstance($model);
        return $adapter->toAttendee();
    }
    public function delete(int $id): bool
    {
        return $this->deleteCommand->execute($id);
    }

    private function validate(array $data)
    {
        Helper::validate($data, AttendeeModel::$rules);
    }
}