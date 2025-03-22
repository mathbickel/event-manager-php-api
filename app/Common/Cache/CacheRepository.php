<?php

namespace App\Common\Cache;

use Exception;

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

    /**
     * @param string $key
     * @return bool
     * @throws Exception
     */
    public function has(string $key): bool;

    /**
     * @param string $key
     * @return string
     */
    public function key(string $resource, int $identifier): string;

    /**
     * @return void
     * @throws Exception
     */
    public function invalidateCache(): void;
}