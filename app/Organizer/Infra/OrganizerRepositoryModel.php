<?php

namespace App\Organizer\Infra;

use App\Organizer\Domain\Organizer;
use App\Organizer\Domain\OrganizerRepository;
use Illuminate\Database\Eloquent\Collection;

class OrganizerRepositoryModel implements OrganizerRepository
{
    public function __construct(
        protected OrganizerModel $organizer
    ){
        $this->organizer = $organizer;   
    }
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->organizer->all();
    }

    /**
     * @param int $id
     * @return OrganizerModel
     */
    public function getOne(int $id): ?OrganizerModel
    {
        return $this->organizer->find($id);
    }

    /**
     * @param array $data
     * @return OrganizerModel
    */
    public function create(array $data): OrganizerModel
    {
        return $this->organizer->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return OrganizerModel
     */
    public function update(array $data, int $id): ?OrganizerModel
    {
        // if(!$this->organizer->find($id)) return null;
        $this->organizer->find($id)->update($data);
        return $this->organizer->find($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->organizer->find($id)->delete();
    }
}