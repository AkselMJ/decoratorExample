<?php
declare(strict_types=1);

namespace Provider;

use Provider\External\ServiceDataProviderInterface;
use UserRequest;

/**
 * Провайдер данных на основе сервиса и запроса
 */
class DataProvider implements DataProviderInterface
{
	/**
	 * Сервис предоставляющий данные
	 *
	 * @var ServiceDataProviderInterface
	 */
	private ServiceDataProviderInterface $service;

	/**
	 * Конструктор
	 *
	 * @param ServiceDataProviderInterface $service
	 */
	public function __construct(ServiceDataProviderInterface $service)
	{
		$this->service = $service;
	}

	/**
	 * Обращается к сервису для получения данных на основе реквеста пользователя
	 *
	 * @param UserRequest $request Запрос
	 *
	 * @return array
	 */
	public function get(UserRequest $request): array
	{
		$data = $request->getData();

		return $this->service->getData($data);
	}
}


