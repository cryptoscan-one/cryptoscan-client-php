<?php

namespace cryptoscan\factory;

use cryptoscan\provider\ApiProviderInterface;
use cryptoscan\provider\GuzzleHttpClient;
use cryptoscan\provider\HttpClientInterface;
use cryptoscan\provider\HttpClientProvider;
use cryptoscan\provider\WebHookProvider;
use cryptoscan\provider\WebHookProviderInterface;

/**
 * Создание провайдера данных
 *
 * Class ProviderFactory
 * @package \cryptoscan\factory
 */
class ProviderFactory
{
    /**
     * ProviderFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * HTTP API провайдер данных
     *
     * @param HttpClientInterface|null $client
     * @return ApiProviderInterface
     */
    public static function http(HttpClientInterface $client = null)
    {
        $client = $client ?: new GuzzleHttpClient();

        return new HttpClientProvider($client);
    }

    /**
     * WebHook провайдер данных
     *
     * @return WebHookProviderInterface
     */
    public static function webHook()
    {
        return new WebHookProvider();
    }
}
