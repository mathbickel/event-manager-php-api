<?php

namespace App\Common;

interface Updater
{
    /**
     * @param int $id
     * @param array $data
     * @return T 
     */
    public function update(array $data, int $id);
}