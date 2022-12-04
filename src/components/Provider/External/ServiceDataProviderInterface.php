<?php

namespace Provider\External;

/**
 * Интерфейс комуникатора с внешним сервисом
 */
interface ServiceDataProviderInterface
{
	public function getData(array $data): array;
}