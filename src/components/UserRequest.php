<?php
declare(strict_types=1);

/**
 * Пользовательский запрос
 */
class UserRequest
{
	/**
	 * Параметры запроса
	 *
	 * @var array
	 */
	private array $data;

	/**
	 * Конструктор
	 *
	 * @param array $data Параметры запроса
	 */
	public function __construct(array $data)
	{
		$this->data = $data;
	}

	/**
	 * Получение параметров
	 *
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}
}