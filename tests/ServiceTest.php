<?php
declare(strict_types=1);

namespace tests;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PHPUnit\Framework\TestCase;
use Provider\CachePool;
use Provider\DataProvider;
use Provider\Decorator\CachedDataProvider;
use Provider\Decorator\LoggedDataProvider;
use Provider\External\CityInfoServiceDataProvider;
use Provider\LoggerProvider;
use RequestFactory;
use UserRequest;

/**
 * Юнит тест для приложения
 */
class ServiceTest extends TestCase
{
	/**
	 * Эталонные данные
	 *
	 * @return array
	 */
	public function dataGetCache()
	{
		return [
			'test 1' => [['city' => 'peterburg'], [1500]]
		];
	}

	/**
	 * @dataProvider dataGetCache
	 *
	 * @param array $data Данные для запроса
	 * @param array $referenceValue Референсное значение
	 *
	 * @throws \Psr\Cache\InvalidArgumentException
	 */
	public function testGetCache(array $data, array $referenceValue): void
	{
		$httpClient = new Client([
			RequestOptions::TIMEOUT => 3
		]);

		$httpRequestFactory = new RequestFactory();

		$service = new CityInfoServiceDataProvider($httpClient, $httpRequestFactory);
		$dataProvider = new DataProvider($service);

		$logger = new LoggerProvider();
		$loggerProvider = new LoggedDataProvider($dataProvider, $logger);

		$cache = new CachePool();
		$cacheProvider = new CachedDataProvider($loggerProvider, $cache);

		$request = new UserRequest($data);
		$result = $cacheProvider->get($request);

		$this->assertEquals($result, $referenceValue);
	}
}