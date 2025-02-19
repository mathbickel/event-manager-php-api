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