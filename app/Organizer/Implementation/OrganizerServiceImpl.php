<?php

namespace App\Organizer\Implementation;

use App\Common\Cache\Cache;
use App\Common\Cache\CacheRepository;
use App\Organizer\Domain\Organizer;
use App\Organizer\Domain\OrganizerService;
use Illuminate\Database\Eloquent\Collection;
use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Common\Error\Error;
use App\Common\Helpers\Helper;
use App\Common\ValidatorService;
use App\Exceptions\NotFoundException;
use App\Organizer\Infra\Adapters\OrganizerModelToOrganizerDataAdapter;
use App\Organizer\Infra\OrganizerModel;
use Exception;

class OrganizerServiceImpl implements OrganizerService
{
    public function __construct(
        private GetAllCommand $getAllCommand,
        private GetOneCommand $getOneCommand,
        private CreateCommand $createCommand,
        private UpdateCommand $updateCommand,
        private DeleteCommand $deleteCommand,
        private CacheRepository $cacheRepository,
        private ValidatorService $validator
    ){}

    /**
    * @return Organizer[]|Collection
    */
    public function getAll(): Collection
    {
        $key = $this->key('organizer', 0);
        if($this->hasCache($key)) return $this->getFromCache($key);
        $data = $this->getAllCommand->execute();
        $this->setCache($key, $data, 3600);
        return $data;
    }

    /**
     * @param int $id
     * @return Organizer
     * @throws Exception
     */
    public function getOne(int $id): Organizer
    {
        $this->failIfNotExists($id);
        $key = $this->key('organizer', $id);
        if($this->hasCache($key)) $model = $this->getFromCache($key);
        $model = $this->getOneCommand->execute($id);
        $this->setCache($key, $model, 3600);
        $adapter = OrganizerModelToOrganizerDataAdapter::getInstance($model);
        return $adapter->toOrganizerData();
    }

    /**
     * @param array $data
     * @return Organizer
     */
    public function create(array $data): Organizer
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        $adapter = OrganizerModelToOrganizerDataAdapter::getInstance($model);
        return $adapter->toOrganizerData();
    }

    /**
     * @param array $data
     * @param int $id
     * @return Organizer
     * @throws Exception
     */
    public function update(array $data, int $id): Organizer
    {
        $this->validateEdit($data);
        $this->failIfNotExists($id);
        $this->cacheRepository->delete($this->key('organizer', $id));
        $model = $this->updateCommand->execute($data, $id);
        $adapter = OrganizerModelToOrganizerDataAdapter::getInstance($model);
        return $adapter->toOrganizerData();
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
     * @param array $data
     */
    private function validate(array $data)
    {
        $this->validator->validate($data, OrganizerModel::$rules);
    }

    /**
     * @param array $data
     */
    private function validateEdit(array $data)
    {
        $this->validator->validateEdit($data, OrganizerModel::$rules);
    }

    /**
     * @param int $id
     * @return void
     * @throws Exception
     */
    private function failIfNotExists(int $id): void
    {
        $key = $this->key('organizer', $id);
        if($this->hasCache($key)) {
            if(!$this->getFromCache($key)) throw new NotFoundException('Resource not found', ['organizer_id' => $id]);
        }
        if(!$this->getOneCommand->execute($id)) throw new NotFoundException('Resource not found', ['organizer_id' => $id]);
    }

    /**
     * @return bool
     */
    private function hasCache(string $key): bool
    {
        if($key) return $this->cacheRepository->has($key);
        return $this->cacheRepository->has($key);
    }

    /**
     * @return Collection
     */
    private function getFromCache(string $key): Collection
    {
        return Collection::make(json_decode($this->cacheRepository->get($key)));
    }

    /**
     * @param Collection $organizer
     * @return void
     */
    private function setCache(string $key, Collection $organizer): void
    {
        $this->cacheRepository->set($key, $organizer, 3600);
    }

    private function key(string $resource, int $identifier)
    {
        return $this->cacheRepository->key($resource, $identifier);
    }
}