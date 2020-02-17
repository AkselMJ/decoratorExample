<?php
declare(strict_types=1);

namespace Provider\Decorator;

use Provider\DataProviderInterface;
use Psr\Log\LoggerInterface;
use UserRequest;

class DecoratorLogger implements DataProviderInterface
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var DataProviderInterface
     */
    private DataProviderInterface $provider;

    /**
     * DecoratorLogger constructor.
     * @param DataProviderInterface $provider
     * @param LoggerInterface $logger
     */
    public function __construct(DataProviderInterface $provider, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->provider = $provider;
    }

    /**
     * Получаем данные или пишет ошибку в случае проблемы
     * @param UserRequest $request
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