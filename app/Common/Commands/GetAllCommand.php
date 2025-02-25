<?php

namespace App\Common\Commands;

class GetAllCommand
{
    public function __construct(
        private $repository
    ) {}
    public function execute()
    {
        return $this->repository->getAll();
    }
}