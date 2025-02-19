<?php

namespace App\Common;

interface Deleter
{
    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}