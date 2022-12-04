<?php
declare(strict_types=1);

namespace Provider\External;

use HttpClient;
use Parser\HttpContentParser;

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
	 * @var HttpClient
	 */
	private HttpClient $client;

	/**
	 * Настройки подключения
	 *
	 * @var array
	 */
	private array $options;

	/**
	 * Конструктор
	 *
	 * @param HttpClient $helper Обработчик запросов
	 * @param array $options Опции запроса
	 */
	public function __construct(HttpClient $helper, array $options)
	{
		$this->client = $helper;
		$this->options = $options;
	}

	/**
	 * Получает данные у сервиса
	 *
	 * @param array $input Информация для получения данных
	 *
	 * @return array
	 * @throws \Exception
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function getData(array $input): array
	{
		$city = $input['city'];
		$this->client->setOptions($this->options);

		$output = $this->client->request(self::CITY_SERVICE_URL);

		$parser = new HttpContentParser($output, $this->client->contentType);
		$data = $parser->parse();

		return [$data[$city]];
	}
}