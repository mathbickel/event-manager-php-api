<?php

namespace App\Organizer\Implementation;

use App\Organizer\Domain\Organizer;
use App\Organizer\Domain\OrganizerRepository;
use App\Organizer\Domain\OrganizerService;
use Illuminate\Database\Eloquent\Collection;

class OrganizerServiceImpl implements OrganizerService
{
    public function __construct(
        private OrganizerRepository $organizerRepository)
    {
        $this->organizerRepository = $organizerRepository;
    }

    public function getAll(): Collection
    {
        return $this->organizerRepository->getAll();
    }

    public function getOne(int $id): Organizer
    {
        return $this->organizerRepository->find($id);
    }

    public function create(array $data): Organizer
    {
        return $this->organizerRepository->create($data);
    }

    public function update(array $data, int $id): Organizer
    {
        return $this->organizerRepository->update($data, $id);
    }

    public function delete(int $id): bool
    {
        return $this->organizerRepository->delete($id);
    }
}