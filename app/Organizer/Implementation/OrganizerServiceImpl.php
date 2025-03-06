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
use App\Common\Error\Error;
use App\Common\Helpers\Helper;
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
        private CacheRepository $cacheRepository
    ){}

    /**
    * @return Organizer[]|Collection
    */
    public function getAll(): Collection
    {
        $this->cacheRepository->set('organizers', $this->getAllCommand->execute(), 3600);
        if($this->cacheRepository->has('organizers')) return $this->cacheRepository->get('organizers');
        return $this->getAllCommand->execute();
    }

    /**
     * @param int $id
     * @return Organizer
     * @throws Exception
     */
    public function getOne(int $id): Organizer
    {
        $this->ifNotExists($id);
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
        $this->ifNotExists($id);
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
        $this->ifNotExists($id);
        $this->deleteCommand->execute($id);
    }

    private function validate(array $data)
    {
        Helper::validate($data, OrganizerModel::$rules);
    }

    private function validateEdit(array $data)
    {
        Helper::validateEdit($data, OrganizerModel::$rules);
    }

    private function ifNotExists(int $id)
    {
        if(!$this->getOneCommand->execute($id)) return Error::handle('Resource not found', ['organizer_id' => $id]);
    }
}