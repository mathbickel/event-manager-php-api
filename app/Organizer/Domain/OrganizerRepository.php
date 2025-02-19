<?php

namespace App\Organizer\Domain;

use App\Common\Getter;
use App\Common\Creator;
use App\Common\Updater;
use App\Common\Deleter;
use Illuminate\Database\Eloquent\Collection;
interface OrganizerRepository extends Getter, Creator, Updater, Deleter
{
    /**
    * @return Collection
    */
    public function getAll(): Collection;

      /**
     * @param int $id
     * @return Organizer
     */
    public function getOne(int $id): Organizer;

    /**
     * @param array $data
     * @return Organizer
     */

    public function create(array $data): Organizer;
    
    /**
     * @param int $id
     * @param array $data
     * @return Organizer
     */

    public function update(array $data, int $id): Organizer;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}