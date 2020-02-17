<?php
declare(strict_types=1);

namespace Provider\Decorator;

use DateTime;
use Provider\DataProviderInterface;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use UserRequest;

class DecoratorCache implements DataProviderInterface
{
    /**
     * @var DataProviderInterface
     */
    private DataProviderInterface $provider;

    /**
     * @var CacheItemPoolInterface
     */
    private CacheItemPoolInterface $cache;

    /**
     * DecoratorCache constructor.
     * @param DataProviderInterface $provider
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(DataProviderInterface $provider, CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
        $this->provider = $provider;
    }

    /**
     * Получаем данные их кеша или запрашиваем и пишем в кеш
     * @param UserRequest $request
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
     * @param $input
     * @return bool
     * @throws \Exception
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function setCache($input): bool {
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
     * @param $input
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
     * @param $input
     * @return string
     */
    public function getCacheKey($input): string
    {
        return md5(json_encode($input));
    }
}