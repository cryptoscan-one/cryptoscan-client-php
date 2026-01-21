<?php

namespace cryptoscan\contract;

/**
 * Список инвойсов
 *
 * Class InvoiceListInterface
 * @package cryptoscan\contract
 */
interface InvoiceListInterface
{
    /**
     * Успешно
     *
     * @return bool
     */
    public function isSuccess();

    /**
     * Инвойсы
     *
     * @return InvoiceListItemInterface[]
     */
    public function getItems();
}