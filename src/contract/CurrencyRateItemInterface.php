<?php

namespace cryptoscan\contract;

/**
 * Валюта
 *
 * Class CurrencyRateItemInterface
 * @package cryptoscan\contract
 */
interface CurrencyRateItemInterface
{
    /** @var string */
    const STATUS_ENABLED = "enabled";

    /** @var string */
    const STATUS_DISABLED = "disabled";

    /**
     * Код валюты
     *
     * @return string
     */
    public function getCurrency();

    /**
     * Курс валюты
     *
     * @return float
     */
    public function getRate();

    /**
     * Статус валюты
     *
     * @return string
     */
    public function getStatus();

    /**
     * Доступна
     *
     * @return bool
     */
    public function isEnabled();
}