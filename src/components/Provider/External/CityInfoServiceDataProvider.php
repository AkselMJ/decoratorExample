<?php
declare(strict_types=1);

namespace Provider\External;

use Parser\HttpContentParser;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

/**
 * Получение данных в севисе городов
 */
class CityInfoServiceDataProvider implements ServiceDataProviderInterface
{
	/**
	 * Адрес источника данных
	 */
	const CITY_SERVICE_URL = 'https://akselmj.github.io/portfolio/assets/example.json';

	/**
	 * Обработчик запросов
	 *
	 * @var ClientInterface
	 */
	private ClientInterface $client;

	/**
	 * @var RequestFactoryInterface
	 */
	private RequestFactoryInterface $requestFactory;

	/**
	 * Конструктор
	 *
	 * @param ClientInterface $helper Обработчик запросов
	 * @param RequestFactoryInterface $httpRequestFactory Фабрика для запросов по PSR
	 */
	public function __construct(ClientInterface $helper, RequestFactoryInterface $httpRequestFactory)
	{
		$this->client = $helper;
		$this->requestFactory = $httpRequestFactory;
	}

	/**
	 * Получает данные у сервиса
	 *
	 * @param array $input Информация для получения данных
	 *
	 * @return array
	 * @throws \Exception
	 * @throws \Psr\Http\Client\ClientExceptionInterface
	 */
	public function getData(array $input): array
	{
		$city = $input['city'];

		$response = $this->client->sendRequest($this->requestFactory->createRequest("GET", self::CITY_SERVICE_URL));

		$output = $response->getBody()->getContents();
		$contentType = $response->getHeader('Content-Type')[0];

		$parser = new HttpContentParser($output, $contentType);
		$data = $parser->parse();

		return [$data[$city]];
	}
}