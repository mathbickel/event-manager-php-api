<?php

namespace App\Common\Cache\Redis;

use App\Common\Cache\CacheRepository;
use App\Common\Cache\Client\CacheClient;
use Predis\Client;

class CacheRedisRepository implements CacheRepository
{
    public function __construct(
        private CacheClient $client
    ) {}

    /**
     * @return Client
     */
    private function connection(): Client
    {
        return $this->client->getClient();
    }

    /**
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public function get(string $key)
    {
        return $this->connection()->get($key);
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
        $connection = $this->connection();
        $connection->set($key, $value);
        if ($ttl !== null) $connection->expire($key, $ttl);
    }

    /**
     * @param string $key
     * @return bool
     * @throws Exception
     */

    public function delete(string $key)
    {
        $this->connection()->del($key);
    }

    /**
     * @param string $key
     * @return bool
     * @throws Exception
     */
    public function has(string $key): bool
    {
        return $this->connection()->exists($key);
    }

    public function key(string $resource, int $identifier): string
    {
        return "{$resource}:{$identifier}";
    }

    public function invalidateCache(): void
    {
        $this->connection()->flushdb();
    }
}