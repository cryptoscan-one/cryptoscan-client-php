<?php

namespace cryptoscan\provider;

use cryptoscan\contract\AuthCredentialsInterface;
use cryptoscan\contract\InvoiceCreatedInterface;

/**
 * Провайдер данных
 *
 * Class DataProviderInterface
 * @package cryptoscan\provider
 */
interface ProviderInterface
{
    /**
     * Установка данных авторизации
     *
     * @param AuthCredentialsInterface $credentials
     * @return InvoiceCreatedInterface
     */
    public function setAuthCredentials(AuthCredentialsInterface $credentials);
}