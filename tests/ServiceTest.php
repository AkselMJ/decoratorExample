<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use Helpers\HttpHelper;
use Provider\CachePool;
use Provider\DataProvider;
use Provider\Decorator\DecoratorCache;
use Provider\Decorator\DecoratorLogger;
use Provider\LoggerProvider;
use Service\CityService;
use UserRequest;

class ServiceTest extends TestCase
{
    /**
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
     * @param $data
     * @param $referenceValue
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function testGetCache($data, $referenceValue): void
    {
        $httpHelper = new HttpHelper();

        $config = (object) [
            'host'      => 'https://akselmj.github.io/portfolio/assets/example.json',
            'user'      => null,
            'password'  => null
        ];

        $service = new CityService($httpHelper, $config);
        $dataProvider = new DataProvider($service);

        $logger = new LoggerProvider();
        $loggerProvider = new DecoratorLogger($dataProvider, $logger);

        $cacher = new CachePool();
        $cacherProvider = new DecoratorCache($loggerProvider, $cacher);

        $request = new UserRequest($data);
        $result = $cacherProvider->get($request);

        $this->assertEquals($result, $referenceValue);
    }
}