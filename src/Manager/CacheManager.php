<?php

namespace Manager;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Менеджер работы с кешем
 *
 * Class CacheManager
 * @package Manager
 */
final class CacheManager implements CacheItemPoolInterface
{
    /** @var CacheItemPoolInterface */
    private $cache;

    /**
     * CacheManager constructor.
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritDoc}
     */
    public function getItem($key)
    {
        return $this->cache->getItem($key);
    }

    /**
     * {@inheritDoc}
     */
    public function getItems(array $keys = [])
    {
        return $this->cache->getItems($keys);
    }

    /**
     * {@inheritDoc}
     */
    public function hasItem($key)
    {
        return $this->cache->hasItem($key);
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        return $this->cache->clear();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteItem($key)
    {
        return $this->cache->deleteItem($key);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteItems(array $keys)
    {
        return $this->cache->deleteItems($keys);
    }

    /**
     * {@inheritDoc}
     */
    public function save(CacheItemInterface $item)
    {
        return $this->cache->save($item);
    }

    /**
     * {@inheritDoc}
     */
    public function saveDeferred(CacheItemInterface $item)
    {
        return $this->cache->saveDeferred($item);
    }

    /**
     * {@inheritDoc}
     */
    public function commit()
    {
        return $this->cache->commit();
    }
}
