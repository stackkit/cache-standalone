<?php

namespace Stackkit\Cachestandalone;

use Illuminate\Cache\CacheManager;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Redis\Database;
use \Illuminate\Cache\MemcachedConnector;

class Cache
{
    private $container;
    private $cacheManager;
    private $cache;

    public function __construct($config)
    {
        $this->container = new Container;
        $this->container['config'] = $config;

        if ($config['cache.default'] == 'file') {
            $this->container['files'] = new Filesystem;
        }

        if ($config['cache.default'] == 'redis') {
            $this->container['redis'] = new Database($this->container['config']['database.redis']);
        }

        if ($config['cache.default'] == 'memcached') {
            $this->container['memcached.connector'] = new MemcachedConnector();
        }

        $this->cacheManager = new CacheManager($this->container);
        $this->cache = $this->cacheManager->store($config['cache.default']);
    }

    public function put($name, $data, $time = 1)
    {
        return $this->cache->put($name, $data, $time);
    }

    public function get($name, $function = null)
    {
        return $this->cache->get($name, $function);
    }

    public function remember($name, $time = 1, $function = null)
    {
        return $this->cache->remember($name, $time, $function);
    }

    public function forget($name) 
    {
        return $this->cache->forget($name);
    }

    public function flush()
    {
        return $this->cache->flush();
    }
}
