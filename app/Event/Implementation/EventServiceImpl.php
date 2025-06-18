<?php

namespace App\Event\Implementation;

use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Event\Domain\Event;
use App\Event\Domain\EventService;
use App\Event\Infra\Adapters\EventModelToEventDataAdapter;
use Illuminate\Database\Eloquent\Collection;
use App\Event\Infra\EventModel;
use Exception;
use App\Common\Cache\CacheRepository;
use App\Common\ValidatorService;
use App\Common\Cache\Trait\CacheTrait;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Arr;

class EventServiceImpl implements EventService
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
    ){}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        $key = $this->cacheRepository->key('event', 0);
        $data = $this->cacheRepository->get($key);
        return $data;
    }

    /**
     * @param int $id
     * @return Event
     * @throws Exception
     */
    public function getOne(int $id): Event
    {
        $this->failIfNotExists($id);
        $key = $this->cacheRepository->key('event', $id);
        $model = $this->getWithCache($key, $id);
        return $this->toEventData($model);
    }

    /**
     * @param array $data
     * @return Event
     */
    public function create(array $data): Event
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        return $this->toEventData($model);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Event
     * @throws Exception
     */
    public function update(array $data, int $id): Event
    {
        $this->validate($data, true);
        $this->failIfNotExists($id);
        $this->cacheRepository->delete($this->cacheRepository->key('event', $id));
        $model = $this->updateCommand->execute($data, $id);
        return $this->toEventData($model);
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
            ? Arr::except(EventModel::$rules, ['required_fields_for_edit']) 
            : EventModel::$rules;
            
        $this->validator->validate($data, $rules);
    }
    
    private function failIfNotExists(int $id)
    {
        $key = $this->cacheRepository->key('event', $id);
        if($this->hasCache($key)) return;
        if(!$this->getOneCommand->execute($id)) throw new NotFoundException('Resource not found', ['event' => $id]);
    }

    private function toEventData(EventModel $model): Event
    {
        return EventModelToEventDataAdapter::getInstance($model)->toEventData();
    }
}

