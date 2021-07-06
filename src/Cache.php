<?php
namespace tesla_ce\client;

use tesla_ce\client\exceptions\CacheObjectNotValid;

class Cache
{
    private $cacheInstance = null;

    public function __construct($cache)
    {
        // check if get and set methods are available
        if (!method_exists($cache, 'set')) {
            throw new CacheObjectNotValid('Set method is not available');
        }

        if (!method_exists($cache, 'get')) {
            throw new CacheObjectNotValid('Get method is not available');
        }
        $this->cacheInstance = $cache;
    }

    public function get($key)
    {
        return $this->cacheInstance->get($key);
    }

    public function set($key, $value)
    {
        return $this->cacheInstance->set($key, $value);
    }
}
