<?php

namespace App\Common\Commands;
class CreateCommand
{
    public function __construct(
        private $repository
    ) {}
    public function execute(array $data)
    {
        return $this->repository->create($data);
    }
}