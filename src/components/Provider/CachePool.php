<?php
declare(strict_types=1);

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

	}

	/**
	 * @inheritDoc
	 */
	public function hasItem($key)
	{

	}

	/**
	 * @inheritDoc
	 */
	public function clear()
	{

	}

	/**
	 * @inheritDoc
	 */
	public function deleteItem($key)
	{

	}

	/**
	 * @inheritDoc
	 */
	public function deleteItems(array $keys)
	{

	}

	/**
	 * @inheritDoc
	 */
	public function save(\Psr\Cache\CacheItemInterface $item)
	{

	}

	/**
	 * @inheritDoc
	 */
	public function saveDeferred(\Psr\Cache\CacheItemInterface $item)
	{

	}

	/**
	 * @inheritDoc
	 */
	public function commit()
	{

	}
}
