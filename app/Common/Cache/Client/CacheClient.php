<?php

namespace App\Common\Cache\Client;

use Predis\Client;
use Predis\Connection\ConnectionInterface;

class CacheClient
{
    public function __construct(
        private Client $client
    ) {}

    /**
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->client->getConnection();
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}