<?php

namespace cryptoscan\factory;

use cryptoscan\AuthPrivetKey;
use cryptoscan\AuthSignature;

/**
 * Создание способа авторизации
 *
 * Class AuthFactory
 * @package \cryptoscan\factory
 */
class AuthFactory
{
    /**
     * AuthFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * По приватному ключу
     *
     * @param $publicKey
     * @param $privateKey
     * @return AuthPrivetKey
     */
    public static function privateKey($publicKey, $privateKey)
    {
        return new AuthPrivetKey($publicKey, $privateKey);
    }

    /**
     * По сигнатуре подписи
     *
     * @param $publicKey
     * @param $privateKey
     * @return AuthSignature
     */
    public static function signature($publicKey, $privateKey)
    {
        return new AuthSignature($publicKey, $privateKey);
    }
}
