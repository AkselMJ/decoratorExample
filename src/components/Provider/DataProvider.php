<?php
declare(strict_types=1);

namespace Provider;

use Service\ServiceInterface;
use UserRequest;

class DataProvider implements DataProviderInterface
{
    /**
     * @var ServiceInterface
     */
    private ServiceInterface $service;

    /**
     * DataProvider constructor.
     * @param ServiceInterface $service
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Обращается к сервису для получения данных на основе реквеста пользователя
     * @param UserRequest $request
     *
     * @return array
     */
    public function get(UserRequest $request): array
    {
        $data = $request->getData();

        return $this->service->getData($data);
    }
}


