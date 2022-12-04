<?php

namespace Provider;

use UserRequest;

/**
 * Интерфейс провайдера предоставляющего данные на основе запроса
 */
interface DataProviderInterface
{
	public function get(UserRequest $request): array;
}