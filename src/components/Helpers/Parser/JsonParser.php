<?php
declare(strict_types=1);

namespace Helpers\Parser;

class JsonParser
{
    /**
     * @var bool
     */
    private bool $toArray;

    /**
     * JsonParser constructor.
     * @param bool $toArray
     */
    public function __construct(bool $toArray = true)
    {
        $this->toArray = $toArray;
    }

    /**
     * Реализует алгоритм парсинга данных
     * @param $data
     * @return mixed
     */
    public function parse($data) {
        return json_decode($data, $this->toArray);
    }
}