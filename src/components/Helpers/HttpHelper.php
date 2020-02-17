<?php
declare(strict_types=1);

namespace Helpers;

/**
 * Инкапсулируем опции и работу с запросами, реализуем объектную модель
 */
class HttpHelper
{
    /**
     * @var string
     */
    public string $contentType;

    /**
	 * @var false|resource
	 */
	private $ch;

    /**
     * @var array
     */
    private array $options = [
        'url'   => CURLOPT_URL,
        'pass'  => CURLOPT_USERPWD
    ];

    /**
	 * HttpHelper constructor.
	 */
	public function __construct()
	{
		// Можно использовать газзл
		$this->ch = curl_init();

		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
	}

    /**
     * Установка опций
     * @param array $options
     */
    public function setOptions(array $options): void
	{
	    foreach ($options as $key => $option) {
            curl_setopt($this->ch, $this->options[$key], $option);
        }
	}

    /**
     * Запрос данных
     * @return string
     * @throws Exception
     */
    public function request(): string {
//        curl_close($this->ch);
//	      return '{}';

		$output = curl_exec($this->ch);
		if(curl_errno($this->ch)){
			throw new \Exception(curl_error($this->ch));
		}
        $this->contentType = curl_getinfo($this->ch, CURLINFO_CONTENT_TYPE);

		curl_close($this->ch);

		return $output;
	}
}