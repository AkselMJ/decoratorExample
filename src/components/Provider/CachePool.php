<?php

namespace Provider;

use Psr\Cache\CacheItemPoolInterface;

class CachePool implements CacheItemPoolInterface
{
    /**
     * @inheritDoc
     */
    public function getItem($key)
    {
        return new CacheItem;
    }

    /**
     * @inheritDoc
     */
    public function getItems(array $keys = [])
    {
        // TODO: Implement getItems() method.
    }

    /**
     * @inheritDoc
     */
    public function hasItem($key)
    {
        // TODO: Implement hasItem() method.
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        // TODO: Implement clear() method.
    }

    /**
     * @inheritDoc
     */
    public function deleteItem($key)
    {
        // TODO: Implement deleteItem() method.
    }

    /**
     * @inheritDoc
     */
    public function deleteItems(array $keys)
    {
        // TODO: Implement deleteItems() method.
    }

    /**
     * @inheritDoc
     */
    public function save(\Psr\Cache\CacheItemInterface $item)
    {
        // TODO: Implement save() method.
    }

    /**
     * @inheritDoc
     */
    public function saveDeferred(\Psr\Cache\CacheItemInterface $item)
    {
        // TODO: Implement saveDeferred() method.
    }

    /**
     * @inheritDoc
     */
    public function commit()
    {
        // TODO: Implement commit() method.
    }
}
