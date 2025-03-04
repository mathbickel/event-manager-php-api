<?php

namespace App\Common\Cache;

class CacheService
{
    public function __construct(
        private CacheRepository $CacheRepository
    ) {
        $this->CacheRepository->getConnection();
    }
    
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
}