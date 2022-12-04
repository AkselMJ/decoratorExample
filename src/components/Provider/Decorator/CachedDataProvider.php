<?php
declare(strict_types=1);

namespace Provider\Decorator;

use DateTime;
use InvalidArgumentException;
use Provider\DataProviderInterface;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use UserRequest;

/**
 * Кеширование получаемых и обрабатываемых данных
 */
class CachedDataProvider implements DataProviderInterface
{
	/**
	 * Провайдер данных
	 *
	 * @var DataProviderInterface
	 */
	private DataProviderInterface $provider;

	/**
	 * Кешер данных
	 *
	 * @var CacheItemPoolInterface
	 */
	private CacheItemPoolInterface $cache;

	/**
	 * Конструктор
	 *
	 * @param DataProviderInterface $provider Провайдер данных
	 * @param CacheItemPoolInterface $cache Кешер данных
	 */
	public function __construct(DataProviderInterface $provider, CacheItemPoolInterface $cache)
	{
		$this->cache = $cache;
		$this->provider = $provider;
	}

	/**
	 * Получаем данные их кеша или запрашиваем и пишем в кеш
	 *
	 * @param UserRequest $request Запрос
	 *
	 * @return array|mixed
	 * @throws \Psr\Cache\InvalidArgumentException
	 */
	public function get(UserRequest $request): array
	{
		$requestData = $request->getData();
		$cacheItem = $this->getCacheItem($requestData);

		if ($cacheItem->isHit()) {
			return $cacheItem->get();
		}

		$data = $this->provider->get($request);
		$this->setCache($data);

		return $data;
	}

	/**
	 * Извлекает кэш
	 *
	 * @param mixed $input Данные для кеширования
	 *
	 * @return bool
	 * @throws \Exception
	 * @throws \Psr\Cache\InvalidArgumentException
	 */
	public function setCache($input): bool
	{
		$cacheItem = $this->getCacheItem($input);

		$cacheItem
			->set($input)
			->expiresAt(
				(new DateTime())->modify('+1 hour')
			);

		$this->cache->save($cacheItem);

		return true;
	}

	/**
	 * Получает кеш из пула
	 *
	 * @param mixed $input Данные
	 *
	 * @return \Psr\Cache\CacheItemInterface
	 * @throws InvalidArgumentException
	 * @throws \Psr\Cache\InvalidArgumentException
	 */
	public function getCacheItem($input): CacheItemInterface
	{
		$cacheKey = $this->getCacheKey($input);
		return $this->cache->getItem($cacheKey);
	}

	/**
	 * Получает ключ кеша по заданному алгоритму
	 *
	 * @param mixed $input Данные
	 *
	 * @return string
	 */
	public function getCacheKey($input): string
	{
		return md5(json_encode($input));
	}
}