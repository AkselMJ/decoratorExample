<?php

use Helpers\HttpHelper;
use Provider\CachePool;
use Provider\DataProvider;
use Provider\Decorator\DecoratorCache;
use Provider\Decorator\DecoratorLogger;
use Provider\LoggerProvider;
use Service\CityService;

require __DIR__ . "/../vendor/autoload.php";

$httpHelper = new HttpHelper();

// todo: GET from registry
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

$request = new UserRequest(['city' => 'perm']);
$result = $cacherProvider->get($request);

var_dump($result);