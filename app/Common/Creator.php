<?php

namespace App\Common;

interface Creator
{
    /**
     * @param array $data
     * @return T 
     */
    public function create(array $data);
}