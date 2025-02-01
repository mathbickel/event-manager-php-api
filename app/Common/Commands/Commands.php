<?php

namespace App\Common\Commands;

class GetAllCommand
{
    public function __construct(
        private $repository
    ){
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function execute()
    {
        return $this->repository->getAll();
    }
}

class GetOneCommand
{
    public function __construct(
        private $repository
    ){
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return T
     */
    public function execute(int $id)    
    {
        return $this->repository->getOne($id);
    }
}

class CreateCommand
{
    public function __construct(
        private $repository
    ){
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return T
     */
    public function execute(array $data)
    {
        return $this->repository->create($data);
    }
}

class UpdateCommand
{
    public function __construct(
        private $repository
    ){
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @param int $id
     * @return T
     */
    public function execute(array $data, int $id)
    {
        return $this->repository->update($data, $id);
    }
}

class DeleteCommand
{
    public function __construct(
        private $repository
    ){
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function execute(int $id)
    {
        return $this->repository->delete($id);
    }
}