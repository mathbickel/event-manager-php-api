<?php

namespace App\Common\Commands;

class GetAllCommand
{
    public function __construct(
        private $repository
    ){
        $this->repository = $repository;
    }
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
    public function execute(int $id)
    {
        return $this->repository->delete($id);
    }
}