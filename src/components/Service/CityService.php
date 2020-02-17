<?php
declare(strict_types=1);

namespace Service;

use Helpers\HttpHelper;
use Helpers\Parser\Parser;
use stdClass;

class CityService implements ServiceInterface
{
    /**
     * @var HttpHelper
     */
    private HttpHelper $helper;

    /**
     * @var stdClass
     */
    private stdClass $config;

    /**
     * ServiceService constructor.
     * @param HttpHelper $helper
     * @param stdClass $config
     */
    public function __construct(HttpHelper $helper, stdClass $config)
    {
        $this->helper = $helper;
        $this->config = $config;
    }

	/**
	 * Получает данные у сервиса
	 * @param array $input
	 * @return array
	 * @throws \Exception
	 */
    public function getData(array $input): array {
        $city = $input['city'];
        $this->helper->setOptions([
            'url'   => $this->config->host . '?' . http_build_query($input),
            'pass'  => $this->config->user . ":" . $this->config->password,
        ]);

        $output = $this->helper->request();

        $parser = new Parser($output, $this->helper->contentType);
        $data = $parser->parse();

        return [$data[$city]];
    }
}