<?php

namespace cryptoscan\factory;

use cryptoscan\contract\FailureInterface;
use cryptoscan\exception\AuthFailureException;
use cryptoscan\exception\ClientExceptionInterface;
use cryptoscan\exception\ClientFailureException;
use cryptoscan\exception\InvalidDataException;
use Psr\Http\Message\ResponseInterface;

/**
 * Создание исключения по ответу
 *
 * Class ResponseExceptionFactory
 * @package \cryptoscan\factory
 */
class ResponseExceptionFactory
{
    /**
     * ResponseExceptionFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * По ответу от сервера
     *
     * @param ResponseInterface $response
     * @param FailureInterface $failure
     * @return ClientExceptionInterface
     */
    public static function createByResponse(
        ResponseInterface $response,
        FailureInterface  $failure
    )
    {
        switch ($response->getStatusCode()) {
            case 400:
                return new InvalidDataException($failure);
            case 401:
                return new AuthFailureException($failure);
            default:
                return new ClientFailureException($failure);
        }
    }
}
