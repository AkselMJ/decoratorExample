<?php

namespace Provider;

use UserRequest;

interface DataProviderInterface
{
    public function get(UserRequest $request): array;
}