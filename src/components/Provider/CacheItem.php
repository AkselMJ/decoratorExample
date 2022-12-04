<?php
declare(strict_types=1);

namespace Provider;

use Psr\Cache\CacheItemInterface;

class CacheItem implements CacheItemInterface
{
	/**
	 * @inheritDoc
	 */
	public function getKey()
	{

	}

	/**
	 * @inheritDoc
	 */
	public function get()
	{

	}

	/**
	 * @inheritDoc
	 */
	public function isHit()
	{

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

	}

	/**
	 * @inheritDoc
	 */
	public function expiresAfter($time)
	{

	}
}
