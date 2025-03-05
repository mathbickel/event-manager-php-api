<?php

namespace App\Common\Cache;

use Exception;
use Predis\Connection\ConnectionException;
use Predis\Connection\ServerException;
use Predis\Connection\ConnectionInterface;

interface CacheRepository
{
    /**
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public function get(string $key);

    /**
     * @param string $key
     * @param mixed $value
     * @param int|null $ttl
     * @return void
     * @throws Exception
     */
    public function set(string $key, $value, ?int $ttl = null);

    /**
     * @param string $key
     * @return void
     * @throws Exception
     */
    public function delete(string $key);
}