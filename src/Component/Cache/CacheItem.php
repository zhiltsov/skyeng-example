<?php

namespace Component\Cache;

use Psr\Cache\CacheItemInterface;

/**
 * Хранилище экземпляра кеша
 *
 * Class CacheItem
 * @package Cache
 */
final class CacheItem implements CacheItemInterface
{
    private $key;
    private $data;
    private $expiration;

    /**
     * CacheItem constructor.
     * @param string $key
     * @param string $data
     * @param \DateTimeInterface|null $expiration
     */
    public function __construct($key, $data = '', \DateTimeInterface $expiration = null)
    {
        $this->key = $key;
        $this->data = $data;
        $this->expiration = $expiration;
    }

    /**
     * {@inheritDoc}
     */
    public function getKey()
    {
        $this->key;
    }

    /**
     * {@inheritDoc}
     */
    public function get()
    {
        $this->data;
    }

    /**
     * {@inheritDoc}
     */
    public function isHit()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function set($value)
    {
        $this->data = $value;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function expiresAt($expiration)
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function expiresAfter($time)
    {
        if ($time instanceof \DateTimeInterface) {
            $this->expiresAt($time);
        } elseif (is_int($time)) {
            $this->expiresAt((new \DateTime())->modify("+${time} seconds"));
        }

        return $this;
    }
}
