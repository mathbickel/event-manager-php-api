<?php

namespace App\Common\Commands;
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