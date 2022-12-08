<?php

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Provider\CachePool;
use Provider\DataProvider;
use Provider\Decorator\CachedDataProvider;
use Provider\Decorator\LoggedDataProvider;
use Provider\External\CityInfoServiceDataProvider;
use Provider\LoggerProvider;

require __DIR__ . "/../vendor/autoload.php";

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

$request = new UserRequest(['city' => 'perm']);
$result = $cacheProvider->get($request);

var_dump($result);