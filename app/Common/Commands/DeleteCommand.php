<?php

namespace App\Common\Commands;
class DeleteCommand
{
    public function __construct(
        private $repository
    ) {}
    public function execute(int $id)
    {
        return $this->repository->delete($id);
    }
}