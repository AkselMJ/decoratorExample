<?php
declare(strict_types=1);

namespace Parser;

use Exception;

/**
 * Парсер данных по типу контента
 */
class HttpContentParser
{
	/**
	 * Парсер
	 *
	 * @var JsonParser
	 */
	private JsonParser $parser;

	/**
	 * Данные для парсинга
	 *
	 * @var string
	 */
	private string $data;

	/**
	 * Конструктор
	 *
	 * @param string $data Данные
	 * @param string $contentType Тип содержимого
	 *
	 * @throws Exception
	 */
	public function __construct(string $data, string $contentType)
	{
		switch ($contentType) {
			case 'application/json; charset=utf-8':
				$this->parser = new JsonParser();
				$this->data = $data;
				break;

			case 'application/xml; charset=utf-8':

				break;

			default:
				throw new Exception('Неизвестный формат');
				break;
		}
	}

	/**
	 * Реализация парсинга
	 *
	 * @return mixed
	 */
	public function parse()
	{
		return $this->parser->parse($this->data);
	}
}