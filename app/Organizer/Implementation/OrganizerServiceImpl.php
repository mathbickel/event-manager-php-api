<?php

namespace App\Organizer\Implementation;

use App\Common\Cache\CacheRepository;
use App\Organizer\Domain\Organizer;
use App\Organizer\Domain\OrganizerService;
use Illuminate\Database\Eloquent\Collection;
use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Common\ValidatorService;
use App\Exceptions\NotFoundException;
use App\Organizer\Infra\Adapters\OrganizerModelToOrganizerDataAdapter;
use App\Organizer\Infra\OrganizerModel;
use Exception;
use Illuminate\Support\Arr;

class OrganizerServiceImpl implements OrganizerService
{
    private const CACHE_TTL = 3600;
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
        $key = $this->cacheRepository->key('organizer', 0);
        $data = $this->getWithCache($key, 0);
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
        $key = $this->cacheRepository->key('organizer', $id);
        $model = $this->getWithCache($key, $id);
        return $this->toOrganizerData($model);
    }

    /**
     * @param array $data
     * @return Organizer
     */
    public function create(array $data): Organizer
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        return $this->toOrganizerData($model);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Organizer
     * @throws Exception
     */
    public function update(array $data, int $id): Organizer
    {
        $this->validate($data, true);
        $this->failIfNotExists($id);
        $this->cacheRepository->delete($this->cacheRepository->key('organizer', $id));
        $model = $this->updateCommand->execute($data, $id);
        return $this->toOrganizerData($model);
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
     * @param bool $isEdit
     * @return void
     */
    private function validate(array $data, bool $isEdit = false)
    {
        $rules = $isEdit 
            ? Arr::except(OrganizerModel::$rules, ['required_fields_for_edit']) 
            : OrganizerModel::$rules;
            
        $this->validator->validate($data, $rules);
    }

    /**
     * @param int $id
     * @return void
     * @throws Exception
     */
    private function failIfNotExists(int $id): void
    {
        $key = $this->cacheRepository->key('organizer', $id);
        if($this->hasCache($key)) return;
        if(!$this->getOneCommand->execute($id)) throw new NotFoundException('Resource not found', ['organizer_id' => $id]);
    }

    /**
     * @return bool
     */
    private function hasCache(string $key): bool
    {
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
        $this->cacheRepository->set($key, $organizer, self::CACHE_TTL);
    }

    /**
     * @param string $key
     * @return OrganizerModel
     */
    private function getFromDbAndSetFirstCache(string $key): OrganizerModel
    {
        $id = $this->cacheRepository->extractIdentifierFrom($key);
        $id != 0 ? 
            $model = $this->getOneCommand->execute($id) 
            : $model = $this->getAllCommand->execute(); 

        if (!$model) {
            throw new NotFoundException("Organizer {$id} not found");
        }

        $this->setCache($key, $model, self::CACHE_TTL);
        return $model;
    }

    /**
     * @param string $key
     */
    private function getWithCache(string $key)
    {   
        return $this->hasCache($key) 
            ? $this->getFromCache($key) 
            : $this->getFromDbAndSetFirstCache($key);
    }

    private function toOrganizerData(OrganizerModel $model): Organizer
    {
        return OrganizerModelToOrganizerDataAdapter::getInstance($model)->toOrganizerData();
    }
}