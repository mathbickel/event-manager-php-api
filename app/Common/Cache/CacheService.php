<?php

namespace App\Common\Cache;

use App\Common\Cache\CacheRepository;
class CacheService
{
    public function __construct(
        private CacheRepository $CacheRepository
    ) {
        $this->CacheRepository->getConnection();
    }

    public static function getInstance()
    {
        return new self(new cacheRepository(new Client()));
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