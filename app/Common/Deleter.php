<?php

namespace App\Common;

interface Deleter
{
    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}