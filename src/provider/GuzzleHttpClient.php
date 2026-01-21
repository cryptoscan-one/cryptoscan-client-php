<?php

namespace cryptoscan\provider;

use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Guzzle HTTP клиент
 *
 * Class GuzzleHttpClient
 * @package cryptoscan\provider
 */
class GuzzleHttpClient extends GuzzleHttp implements HttpClientInterface
{
    /**
     * @inheritDoc
     */
    public function __construct(array $config = [])
    {
        $config = array_merge($config, [
            'base_uri' => self::BASE_URL,
        ]);
        parent::__construct($config);
    }

    /**
     * @inheritDoc
     * @throws GuzzleException
     */
    public function sendRequest($method, $uri = '', array $headers = [], array $data = [])
    {
        try {
            return $this->request($method, $uri, [
                'json' => $data,
                'headers' => $headers,
            ]);
        } catch (ClientException $exception) {
            return $exception->getResponse();
        }
    }
}
