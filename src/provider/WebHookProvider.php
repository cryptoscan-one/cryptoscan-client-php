<?php

namespace cryptoscan\provider;

use cryptoscan\contract\AuthCredentialsInterface;
use cryptoscan\exception\AuthFailureException;
use cryptoscan\factory\WebHookMessageFactory;
use cryptoscan\webhook\WebHookAuthFailure;
use cryptoscan\webhook\WebHookDataInterface;

/**
 * WebHook провайдер данных
 *
 * Class WebHookProvider
 * @package cryptoscan\provider
 */
class WebHookProvider implements WebHookProviderInterface
{
    /**
     * @var AuthCredentialsInterface|null
     */
    private $authCredentials;

    /**
     * @inheritDoc
     */
    public function setAuthCredentials(AuthCredentialsInterface $credentials)
    {
        $this->authCredentials = $credentials;
    }

    /**
     * @inheritDoc
     */
    public function messageHandler(WebHookDataInterface $request)
    {
        if ($this->isAuth($request) === false) {
            $failure = new WebHookAuthFailure();

            throw new AuthFailureException($failure);
        }

        return WebHookMessageFactory::createByRequest($request);
    }

    /**
     * Проверка данных авторизации
     *
     * @param WebHookDataInterface $request
     * @return bool
     */
    private function isAuth(WebHookDataInterface $request)
    {
        $authorize = $request->getAuthorize();
        $credentials = $this->authCredentials;
        $data = $request->getData();

        return $credentials->isAccessConfirmed($authorize, $data) === true;
    }
}