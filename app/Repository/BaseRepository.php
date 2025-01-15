<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
interface BaseRepository
{
    /**
    * @return Collection
    */
    public function getAll(): Collection;

      /**
     * @param int $id
     * @return T
     */
    public function find(int $id);

    /**
     * @param array $data
     * @return T 
     */

    public function create(array $data);
    
    /**
     * @param int $id
     * @param array $data
     * @return T 
     */

    public function update(array $data, int $id);

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}