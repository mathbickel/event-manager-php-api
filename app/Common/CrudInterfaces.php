<?php

namespace App\Common;

use Illuminate\Database\Eloquent\Collection;

interface Getter
{
    /**
     * @return Collection
    */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return T
    */
    public function getOne(int $id);
}

interface Creator
{
    /**
     * @param array $data
     * @return T 
    */
    public function create(array $data);
}

interface Updater
{
    /**
     * @param int $id
     * @param array $data
     * @return T 
    */
    public function update(array $data, int $id);
}

interface Deleter
{
    /**
     * @param int $id
     * @return bool
    */
    public function delete(int $id): bool;
}