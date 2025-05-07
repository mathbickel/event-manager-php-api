<?php

namespace App\Ticket\Implementation;

use App\Ticket\Domain\Ticket;
use App\Ticket\Domain\TicketService;
use Illuminate\Database\Eloquent\Collection;
use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use App\Common\Commands\CreateCommand;
use App\Common\Commands\UpdateCommand;
use App\Common\Commands\DeleteCommand;
use App\Ticket\Infra\Adapters\TicketModelToTicketDataAdapter;
use App\Ticket\Infra\TicketModel;
use App\Common\ValidatorService;
use App\Common\Cache\CacheRepository;
use App\Common\Cache\Trait\CacheTrait;
use Illuminate\Support\Arr;
use Exception;
use App\Exceptions\NotFoundException;

class TicketServiceImpl implements TicketService
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
        $key = $this->cacheRepository->key('ticket', 0);
        $data = $this->cacheRepository->get($key);
        return $data;
    }

    /**
     * @param int $id
     * @return Ticket
     * @throws Exception
     */
    public function getOne(int $id): Ticket
    {
        $this->failIfNotExists($id);
        $key = $this->cacheRepository->key('ticket', $id);
        $model = $this->getWithCache($key, $id);
        return $this->toTicketData($model);
    }

    /**
     * @param array $data
     * @return Ticket
     */
    public function create(array $data): ?Ticket
    {
        $this->validate($data);
        $model = $this->createCommand->execute($data);
        return $this->toTicketData($model);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Ticket
     * @throws Exception
     */
    public function update(array $data, int $id): ?Ticket
    {
        $this->validate($data);
        $this->failIfNotExists($id);
        $this->cacheRepository->delete($this->cacheRepository->key('ticket', $id));
        $model = $this->updateCommand->execute($data, $id);
        return $this->toTicketData($model);
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
            ? Arr::except(TicketModel::$rules, ['required_fields_for_edit']) 
            : TicketModel::$rules;
            
        $this->validator->validate($data, $rules);
    }

    private function failIfNotExists(int $id)
    {
        $key = $this->cacheRepository->key('ticket', $id);
        if($this->hasCache($key)) return;
        if(!$this->getOneCommand->execute($id)) throw new NotFoundException('Resource not found', ['ticket' => $id]);
    }

    private function toTicketData(TicketModel $model): Ticket
    {
        return TicketModelToTicketDataAdapter::getInstance($model)->toTicketData();
    }
}