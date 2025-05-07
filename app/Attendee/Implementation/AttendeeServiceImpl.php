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
use Exception;
use App\Common\Cache\CacheRepository;
use App\Common\ValidatorService;
use App\Common\Cache\Trait\CacheTrait;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Arr;


class AttendeeServiceImpl implements AttendeeService
{
    use CacheTrait;

    public function __construct(
        private GetAllCommand $getAllCommand,
        private GetOneCommand $getOneCommand,
        private CreateCommand $createCommand,
        private UpdateCommand $updateCommand,
        private DeleteCommand $deleteCommand,
        private ValidatorService $validator,
        private CacheRepository $cacheRepository
    ) {}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        $key = $this->cacheRepository->key('attendee', 0);
        $data = $this->cacheRepository->get($key);
        return $data;
    }

    /**
     * @param int $id
     * @return Attendee
     * @throws Exception
     */
    public function getOne(int $id): Attendee
    {
        $this->failIfNotExists($id);
        $key = $this->cacheRepository->key('attendee', $id);
        $model = $this->getWithCache($key, $id);
        return $this->toAttendeeData($model);
    }

    /**
     * @param array $data
     * @return Attendee
     */
    public function create(array $data): Attendee
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        return $this->toAttendeeData($model);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Attendee
     * @throws Exception
     */
    public function update(array $data, int $id): Attendee
    {
        $this->validate($data);
        $this->failIfNotExists($id);
        $this->cacheRepository->delete($this->cacheRepository->key('attendee', $id));
        $model = $this->updateCommand->execute($data, $id);
        return $this->toAttendeeData($model);
    }

    /**
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $this->failIfNotExists($id);
        $this->deleteCommand->execute($id);
    }

     /**
     * @return CacheRepository
     */
    public function getCacheRepository(): CacheRepository
    {
        return $this->cacheRepository;
    }

    /**
     * @return GetAllCommand
     */

    public function getGetAllCommand(): GetAllCommand
    {
        return $this->getAllCommand;
    }
    
    /**
     * @return GetOneCommand
     */
    public function getGetOneCommand(): GetOneCommand
    {
        return $this->getOneCommand;
    }

    /**
     * @param array $data
     * @param bool $isEdit
     * @return void
     */
    private function validate(array $data, bool $isEdit = false)
    {
        $rules = $isEdit 
            ? Arr::except(AttendeeModel::$rules, ['required_fields_for_edit']) 
            : AttendeeModel::$rules;
            
        $this->validator->validate($data, $rules);
    }
    
    private function failIfNotExists(int $id)
    {
        $key = $this->cacheRepository->key('event', $id);
        if($this->hasCache($key)) return;
        if(!$this->getOneCommand->execute($id)) throw new NotFoundException('Resource not found', ['attendee' => $id]);
    }

    private function toAttendeeData(AttendeeModel $model): Attendee
    {
        return AttendeeModelToAttendeeDataAdapter::getInstance($model)->toAttendee();
    }

}