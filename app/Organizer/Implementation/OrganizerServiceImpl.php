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
        private CacheRepository $CacheRepository,
        private ValidatorService $validator
    ){}

    /**
    * @return Organizer[]|Collection
    */
    public function getAll(): Collection
    {
        if($this->hasCache()) return $this->getFromCache();
        $data = $this->getAllCommand->execute();
        $this->setCache($data);
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
        $model = $this->getOneCommand->execute($id);
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
        if(!$this->getOneCommand->execute($id)) throw new NotFoundException('Resource not found', ['organizer_id' => $id]);
    }

    /**
     * @return bool
     */
    private function hasCache(): bool
    {
        return $this->CacheRepository->has('organizers');
    }

    /**
     * @return Collection
     */
    private function getFromCache(): Collection
    {
        return Collection::make($this->CacheRepository->get('organizers'));
    }

    /**
     * @param Collection $organizer
     * @return void
     */
    private function setCache(Collection $organizer): void
    {
        $this->CacheRepository->set('organizers', $organizer, 3600);
    }
}