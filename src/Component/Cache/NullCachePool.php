<?php

namespace Component\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Кеш-заглушка
 * Class NullCachePool
 * @package Component\Cache
 */
class NullCachePool implements CacheItemPoolInterface
{
    /**
     * {@inheritDoc}
     */
    public function getItem($key)
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getItems(array $keys = [])
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function hasItem($key)
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteItem($key)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteItems(array $keys)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function save(CacheItemInterface $item)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function saveDeferred(CacheItemInterface $item)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function commit()
    {
        return true;
    }
}
