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
use App\Common\Cache\Trait\CacheTrait;

class OrganizerServiceImpl implements OrganizerService
{
    use CacheTrait;

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

    private function toOrganizerData(OrganizerModel $model): Organizer
    {
        return OrganizerModelToOrganizerDataAdapter::getInstance($model)->toOrganizerData();
    }
}