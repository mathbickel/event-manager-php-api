<?php

namespace App\Schedule\Implementation;

use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Common\Helpers\Helper;
use App\Schedule\Domain\Schedule;
use App\Schedule\Domain\ScheduleService;
use Illuminate\Database\Eloquent\Collection;
use App\Schedule\Infra\Adapters\ScheduleModelToScheduleDataAdapter;
use App\Schedule\Infra\ScheduleModel;
use App\Common\Error\Error;
use Exception;
use App\Common\Cache\CacheRepository;
use App\Common\ValidatorService;
use App\Common\Cache\Trait\CacheTrait;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Arr;

class ScheduleServiceImpl implements ScheduleService
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
        $key = $this->cacheRepository->key('schedule', 0);
        $data = $this->cacheRepository->get($key);
        return $data;
    }

    /**
     * @param int $id
     * @return Schedule
     * @throws Exception
     */
    public function getOne(int $id): ?Schedule
    {
        $this->failIfNotExists($id);
        $key = $this->cacheRepository->key('schedule', $id);
        $model = $this->getWithCache($key, $id);
        return $this->toScheduleData($model);
    }

    /**
     * @param array $data
     * @return Schedule
     */
    public function create(array $data): Schedule
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        return $this->toScheduleData($model);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Schedule
     * @throws Exception
     */
    public function update(array $data, int $id): ?Schedule
    {
        $this->validate($data);
        $this->failIfNotExists($id);
        $this->cacheRepository->delete($this->cacheRepository->key('event', $id));
        $model = $this->updateCommand->execute($data, $id);
        return $this->toScheduleData($model);
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
            ? Arr::except(ScheduleModel::$rules, ['required_fields_for_edit']) 
            : ScheduleModel::$rules;
            
        $this->validator->validate($data, $rules);
    }
    
    private function failIfNotExists(int $id)
    {
        $key = $this->cacheRepository->key('schedule', $id);
        if($this->hasCache($key)) return;
        if(!$this->getOneCommand->execute($id)) throw new NotFoundException('Resource not found', ['schedule' => $id]);
    }

    private function toScheduleData(ScheduleModel $model): Schedule
    {
        return ScheduleModelToScheduleDataAdapter::getInstance($model)->toScheduleData();
    }

}