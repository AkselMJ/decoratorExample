<?php

use Provider\CachePool;
use Provider\DataProvider;
use Provider\Decorator\CachedDataProvider;
use Provider\Decorator\LoggedDataProvider;
use Provider\External\CityInfoServiceDataProvider;
use Provider\LoggerProvider;

require __DIR__ . "/../vendor/autoload.php";

$httpHelper = new HttpClient();

$options = [
	HttpClient::TIMEOUT => 3,
];

$service = new CityInfoServiceDataProvider($httpHelper, $options);
$dataProvider = new DataProvider($service);

$logger = new LoggerProvider();
$loggerProvider = new LoggedDataProvider($dataProvider, $logger);

$cache = new CachePool();
$cacheProvider = new CachedDataProvider($loggerProvider, $cache);

$request = new UserRequest(['city' => 'perm']);
$result = $cacheProvider->get($request);

var_dump($result);