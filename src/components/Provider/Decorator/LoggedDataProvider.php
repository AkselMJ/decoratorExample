<?php
declare(strict_types=1);

namespace Provider\Decorator;

use Provider\DataProviderInterface;
use Psr\Log\LoggerInterface;
use UserRequest;

/**
 * Логирование ошибок выполнения
 */
class LoggedDataProvider implements DataProviderInterface
{
	/**
	 * Провайдер данных
	 *
	 * @var DataProviderInterface
	 */
	private DataProviderInterface $provider;

	/**
	 * Логер ошибок
	 *
	 * @var LoggerInterface
	 */
	private LoggerInterface $logger;

	/**
	 * Конструктор
	 *
	 * @param DataProviderInterface $provider Провайдер данных
	 * @param LoggerInterface $logger Логер ошибок
	 */
	public function __construct(DataProviderInterface $provider, LoggerInterface $logger)
	{
		$this->logger = $logger;
		$this->provider = $provider;
	}

	/**
	 * Получаем данные или пишет ошибку в случае проблемы
	 *
	 * @param UserRequest $request Запрос
	 *
	 * @return array
	 */
	public function get(UserRequest $request): array
	{
		try {
			return $this->provider->get($request);
		} catch (\Exception $e) {
			$this->logger->critical($e, debug_backtrace());
		}

		return [];
	}
}