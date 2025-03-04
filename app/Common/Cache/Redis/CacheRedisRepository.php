<?php

namespace App\Common\Cache\Redis;

use App\Common\Cache\CacheRepository;
use App\Common\Cache\Client\CacheClient;
class CacheRedisRepository implements CacheRepository
{
    public function __construct(
        private CacheClient $client
    ) {}

    /**
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->client->getConnection();
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param int|null $ttl
     * @return void
     * @throws Exception
     */
    public function set(string $key, $value, ?int $ttl = null): void
    {
        $this->client->set($key, $value, $ttl);

        if ($ttl !== null) {
            $this->client->expire($key, $ttl);
        }
    }

    /**
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public function get(string $key)
    {
        return $this->client->get($key);
    }

    /**
     * @param string $key
     * @return bool
     * @throws Exception
     */

    public function delete(string $key)
    {
        $this->client->del($key);
    }
}