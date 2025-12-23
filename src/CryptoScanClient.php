<?php

namespace cryptoscan;

use cryptoscan\command\InvoiceConfirm;
use cryptoscan\command\InvoiceCreate;
use cryptoscan\command\WidgetCreate;
use cryptoscan\contract\CurrencyRateListInterface;
use cryptoscan\contract\CurrencyRateStatusInterface;
use cryptoscan\contract\InvoiceCreatedInterface;
use cryptoscan\contract\InvoiceDetailedInterface;
use cryptoscan\contract\InvoiceListInterface;
use cryptoscan\contract\UserDetailInterface;
use cryptoscan\contract\WidgetCreatedInterface;
use cryptoscan\factory\ProviderFactory;
use cryptoscan\contract\AuthCredentialsInterface;
use cryptoscan\provider\ApiProviderInterface;

/**
 * Клиент работы с сервисом CryptoScan
 *
 * Class CryptoScanClient
 * @package cryptoscan
 *
 * @method InvoiceCreatedInterface invoiceCreate(InvoiceCreate $command) Создание Инвойса
 * @method WidgetCreatedInterface widgetCreate(WidgetCreate $command) Создание Виджета для Инвойса
 * @method InvoiceDetailedInterface invoiceDetail(int $id) Просмотр Инвойса
 * @method InvoiceListInterface invoiceSearch($query) Поиск Инвойса
 * @method InvoiceDetailedInterface invoiceConfirm(InvoiceConfirm $command) Ручное подтверждение Инвойса
 * @method UserDetailInterface userDetail() Просмотр информации о пользователе
 * @method CurrencyRateListInterface currencyRate() Поддерживаемые валюты
 * @method CurrencyRateStatusInterface currencyRateStatus(string $currency) Проверка доступности валюты
 */
class CryptoScanClient
{
    /**
     * Данные авторизации
     *
     * @var AuthCredentialsInterface
     */
    private $authCredentials;

    /**
     * Провайдер данных
     *
     * @var ApiProviderInterface
     */
    private $provider;

    /**
     * CryptoScan constructor.
     * @param AuthCredentialsInterface $authCredentials
     * @param ApiProviderInterface|null $provider
     */
    public function __construct(
        AuthCredentialsInterface $authCredentials,
        ApiProviderInterface     $provider = null
    )
    {
        $this->authCredentials = $authCredentials;
        $this->setProvider($provider);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this
            ->provider
            ->$name(...$arguments);
    }

    /**
     * Установка провайдера данных
     *
     * @param ApiProviderInterface|null $provider
     * @return void
     */
    private function setProvider(ApiProviderInterface $provider = null)
    {
        $provider = $provider ?: ProviderFactory::http();
        $provider->setAuthCredentials($this->authCredentials);

        $this->provider = $provider;
    }
}
