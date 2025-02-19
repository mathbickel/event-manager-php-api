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
    public function getOne(int $id): Organizer
    {
        return $this->organizer->find($id);
    }

    /**
     * @param array $data
     * @return Organizer
     */
    public function create(array $data): Organizer
    {
        $model = $this->organizer->create($data);
        $data = new OrganizerModelToOrganizerDataAdapter::getInstance($model);
        return $data;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Organizer
     */
    public function update(array $data, int $id): Organizer
    {
        return $this->organizer->find($id)->update($data);
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