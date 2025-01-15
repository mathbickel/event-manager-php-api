<?php

namespace App\Organizer\Domain;

use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
interface OrganizerRepository extends BaseRepository
{
    /**
    * @return Collection
    */
    public function getAll(): Collection;

      /**
     * @param int $id
     * @return Organizer
     */
    public function find(int $id): Organizer;

    /**
     * @param array $data
     * @return T 
     */

    public function create(array $data): Organizer;
    
    /**
     * @param int $id
     * @param array $data
     * @return T 
     */

    public function update(array $data, int $id): Organizer;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}