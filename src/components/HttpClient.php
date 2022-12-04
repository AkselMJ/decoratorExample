<?php
declare(strict_types=1);

use GuzzleHttp\Client;

/**
 * Помощник-обертка для запросов
 */
class HttpClient
{
	/**
	 * Таймаут запросов
	 */
	const TIMEOUT = 'timeout';

	/**
	 * Тип данных
	 *
	 * @var string
	 */
	public string $contentType;

	/**
	 * Клиент
	 *
	 * @var Client
	 */
	private Client $client;

	/**
	 * Опции запроса
	 *
	 * @var array
	 */
	private array $options;

	/**
	 * Конструктор
	 */
	public function __construct()
	{
		$this->client = new Client();
	}

	/**
	 * Установка опций
	 *
	 * @param array $options Задаваемые опции
	 *
	 * @return void
	 */
	public function setOptions(array $options): void
	{
		foreach ($options as $key => $option) {
			$this->options[$key] = $option;
		}
	}

	/**
	 * Запрос данных
	 *
	 * @param string $uri Ресурс для запроса
	 *
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function request(string $uri): string
	{
		$response = $this->client->request('GET', $uri, $this->options);

		$this->contentType = $response->getHeader('Content-Type')[0];

		return $response->getBody()->getContents();
	}
}