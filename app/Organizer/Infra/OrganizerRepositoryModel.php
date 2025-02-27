<?php

namespace App\Organizer\Infra;

use App\Organizer\Domain\Organizer;
use App\Organizer\Domain\OrganizerRepository;
use Illuminate\Database\Eloquent\Collection;

class OrganizerRepositoryModel implements OrganizerRepository
{
    public function __construct(
        protected OrganizerModel $organizer
    ) {}
    
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
        $this->organizer->find($id)->update($data);
        return $this->organizer->find($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->organizer->find($id)->delete();
    }
}