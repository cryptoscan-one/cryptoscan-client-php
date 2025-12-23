<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.06.2023
 * Time: 13:29
 */

namespace cryptoscan;

use cryptoscan\contract\AuthCredentialsInterface;
use cryptoscan\factory\ProviderFactory;
use cryptoscan\provider\WebHookProviderInterface;
use cryptoscan\webhook\WebHookMessage;
use cryptoscan\webhook\WebHookDataInterface;

/**
 * Обработка сообщения WebHook
 *
 * Class WebHookHandler
 * @package cryptoscan
 */
class WebHookHandler
{
    /**
     * @var AuthCredentialsInterface
     */
    private $authCredentials;

    /**
     * @var WebHookProviderInterface
     */
    private $provider;

    /**
     * @param AuthCredentialsInterface $authCredentials
     * @param WebHookProviderInterface|null $provider
     */
    public function __construct(
        AuthCredentialsInterface $authCredentials,
        WebHookProviderInterface $provider = null
    )
    {
        $this->authCredentials = $authCredentials;
        $this->setProvider($provider);
    }

    /**
     * @param WebHookDataInterface $request
     * @return WebHookMessage
     */
    public function handle(WebHookDataInterface $request)
    {
        return $this
            ->provider
            ->messageHandler($request);
    }

    /**
     * Установка провайдера данных
     *
     * @param WebHookProviderInterface|null $provider
     * @return void
     */
    private function setProvider(WebHookProviderInterface $provider = null)
    {
        $provider = $provider ?: ProviderFactory::webHook();
        $provider->setAuthCredentials($this->authCredentials);

        $this->provider = $provider;
    }
}