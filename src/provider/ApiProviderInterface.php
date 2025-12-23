<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 07.06.2023
 * Time: 9:59
 */

namespace cryptoscan\provider;

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

/**
 * API провайдер данных
 *
 * Class ApiProviderInterface
 * @package cryptoscan\provider
 */
interface ApiProviderInterface extends ProviderInterface
{
    /**
     * Создание инвойса
     *
     * @param InvoiceCreate $command
     * @return InvoiceCreatedInterface
     */
    public function invoiceCreate(InvoiceCreate $command);

    /**
     * Создание виджета
     *
     * @param WidgetCreate $command
     * @return WidgetCreatedInterface
     */
    public function widgetCreate(WidgetCreate $command);

    /**
     * Просмотр инвойса
     *
     * @param int $id
     * @return InvoiceDetailedInterface
     */
    public function invoiceDetail($id);

    /**
     * Поиск инвойсов
     *
     * @param string $query
     * @return InvoiceListInterface
     */
    public function invoiceSearch($query);

    /**
     * Ручное подтверждение платежа
     *
     * @param InvoiceConfirm $command
     * @return InvoiceDetailedInterface
     */
    public function invoiceConfirm(InvoiceConfirm $command);

    /**
     * Информация по пользователю
     *
     * @return UserDetailInterface
     */
    public function userDetail();

    /**
     * Поддерживаемые валюты
     *
     * @return CurrencyRateListInterface
     */
    public function currencyRate();

    /**
     * Поддерживаемые валюты
     *
     * @param string $currency
     * @return CurrencyRateStatusInterface
     */
    public function currencyRateStatus($currency);
}
