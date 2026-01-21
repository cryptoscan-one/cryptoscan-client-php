<?php

namespace cryptoscan\provider;

use Psr\Http\Message\ResponseInterface;

/**
 * HTTP клиент для провайдера данных
 *
 * Class HttpClientInterface
 * @package cryptoscan\provider
 */
interface HttpClientInterface
{
    /**
     * Base URL
     * @var string
     */
    const BASE_URL = 'https://cryptoscan.one/api/v1/';

    /**
     * @param $method
     * @param $uri
     * @param array $headers
     * @param array $data
     * @return ResponseInterface
     */
    public function sendRequest($method, $uri, array $headers = [], array $data = []);
}
