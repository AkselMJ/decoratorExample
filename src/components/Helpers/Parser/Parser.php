<?php
declare(strict_types=1);

namespace Helpers\Parser;

class Parser
{
    /**
     * @var JsonParser
     */
    private JsonParser $parser;

    private $input;

    /**
     * Parser constructor.
     * @param $input
     * @param string $contentType
     * @throws Exception
     */
    public function __construct($input, string $contentType)
    {
        switch ($contentType) {
            case 'application/json; charset=utf-8':
                $this->parser = new JsonParser();
                $this->input = $input;
            break;

            default:
                throw new Exception('Неизвестный формат');
            break;
        }
    }

    /**
     * @return mixed
     */
    public function parse() {
       return $this->parser->parse($this->input);
    }
}