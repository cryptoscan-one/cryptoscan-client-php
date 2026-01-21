<?php

namespace cryptoscan\contract;

/**
 * Поддерживаемые валюты
 *
 * Class CurrencyRateListInterface
 * @package cryptoscan\contract
 */
interface CurrencyRateListInterface
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
     * @return CurrencyRateItemInterface[]
     */
    public function getItems();
}