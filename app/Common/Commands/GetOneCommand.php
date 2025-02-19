<?php

namespace App\Common\Commands;
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