<?php

namespace cryptoscan\entity;

use cryptoscan\exception\InvalidArgumentException;

/**
 * Данные авторизации
 *
 * Class Authorize
 * @package cryptoscan\entity
 */
class Authorize
{
    /**
     * Публичный ключ
     *
     * @var string
     */
    private $publicKey;

    /**
     * Данные авторизации
     *
     * @var string
     */
    private $credentials;

    /**
     * @param $publicKey
     * @param $credentials
     */
    public function __construct($publicKey, $credentials)
    {
        self::assertPublicKey($publicKey);
        self::assertCredentials($credentials);

        $this->publicKey = $publicKey;
        $this->credentials = $credentials;
    }

    /**
     * @param $value
     * @return void
     */
    private static function assertPublicKey($value)
    {
        if (empty($value) === true) {
            throw new InvalidArgumentException("PublicKey can not to be empty");
        }

        if (is_string($value) === false) {
            throw new InvalidArgumentException("PublicKey is not valid");
        }
    }

    /**
     * @param $value
     * @return void
     */
    private static function assertCredentials($value)
    {
        if (empty($value) === true) {
            throw new InvalidArgumentException("Credentials can not to be empty");
        }

        if (is_string($value) === false) {
            throw new InvalidArgumentException("Credentials is not valid");
        }
    }

    /**
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * @return string
     */
    public function getCredentials()
    {
        return $this->credentials;
    }
}