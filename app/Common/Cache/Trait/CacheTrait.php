<?php

namespace App\Common\Cache\Trait;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Collection;
use App\Common\Cache\CacheRepository;
use App\Common\Commands\GetAllCommand;
use App\Common\Commands\GetOneCommand;
use Illuminate\Database\Eloquent\Model;

trait CacheTrait
{
    private const CACHE_TTL = 3600;

    abstract protected function getCacheRepository(): CacheRepository;
    abstract protected function getGetAllCommand(): GetAllCommand;
    abstract protected function getGetOneCommand(): GetOneCommand;

    /**
     * @return bool
     */
    public function hasCache(string $key): bool
    {
        return $this->getCacheRepository()->has($key);
    }

    /**
     * @return Collection
     */
    public function getFromCache(string $key): Collection
    {
        return Collection::make(json_decode($this->cacheRepository->get($key)));
    }

    /**
     * @param Collection $domain
     * @return void
     */
    public function setCache(string $key, Collection $domain): void
    {
        $this->cacheRepository->set($key, $domain, self::CACHE_TTL);
    }

    /**
     * @param string $key
     */

    public function getFromDbAndSetFirstCache(string $key)
    {
        $id = $this->cacheRepository->extractIdentifierFrom($key);
        $id != 0 
            ? $model = $this->getGetOneCommand()->execute($id) 
            : $model = $this->getGetAllCommand()->execute(); 

        if (!$model) {
            throw new NotFoundException("{$id} not found");
        }

        $this->setCache($key, $model, self::CACHE_TTL);
        return $model;
    }

    /**
     * @param string $key
     */
    public function getWithCache(string $key)
    {   
        return $this->hasCache($key) 
            ? $this->getFromCache($key) 
            : $this->getFromDbAndSetFirstCache($key);
    }
}