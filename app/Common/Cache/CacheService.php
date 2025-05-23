<?php

namespace App\Common\Cache;

use App\Common\Cache\CacheRepository;
class CacheService
{
    public function __construct(
        private CacheRepository $CacheRepository
    ) {}
    
    public function set(string $key, $value, ?int $ttl = null)
    {
        $this->CacheRepository->set($key, $value, $ttl);
    }

    public function get(string $key)
    {
        return $this->CacheRepository->get($key);
    }

    public function delete(string $key)
    {
        $this->CacheRepository->delete($key);
    }

    public function has(string $key)
    {
        return $this->CacheRepository->has($key);
    }

    public function invalidateCache()
    {
        $this->CacheRepository->invalidateCache();
    }

    public function key(string $resource, int $identifier)
    {
        return $this->CacheRepository->key($resource, $identifier);
    }
}