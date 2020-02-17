<?php

namespace Provider;

use Psr\Cache\CacheItemInterface;

class CacheItem implements CacheItemInterface
{
    /**
     * @inheritDoc
     */
    public function getKey()
    {
        // TODO: Implement getKey() method.
    }

    /**
     * @inheritDoc
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @inheritDoc
     */
    public function isHit()
    {
        // TODO: Implement isHit() method.
    }

    /**
     * @inheritDoc
     */
    public function set($value)
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function expiresAt($expiration)
    {
        // TODO: Implement expiresAt() method.
    }

    /**
     * @inheritDoc
     */
    public function expiresAfter($time)
    {
        // TODO: Implement expiresAfter() method.
    }
}
