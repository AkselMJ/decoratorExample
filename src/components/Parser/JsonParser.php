<?php
declare(strict_types=1);

namespace Parser;

/**
 * Парсер JSON
 */
class JsonParser
{
	/**
	 * Флаг: разбирать json в массив
	 *
	 * @var bool
	 */
	private bool $toArray;

	/**
	 * Конструктор
	 *
	 * @param bool $toArray
	 */
	public function __construct(bool $toArray = true)
	{
		$this->toArray = $toArray;
	}

	/**
	 * Реализует алгоритм парсинга данных
	 *
	 * @param string $data Json-данные
	 *
	 * @return mixed
	 */
	public function parse(string $data)
	{
		return json_decode($data, $this->toArray);
	}
}