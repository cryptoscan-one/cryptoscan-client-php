<?php

namespace cryptoscan\contract;

/**
 * Статус валюты
 *
 * Class CurrencyRateStatusInterface
 * @package cryptoscan\contract
 */
interface CurrencyRateStatusInterface
{
    /** @var string */
    const STATUS_ENABLED = "enabled";

    /** @var string */
    const STATUS_DISABLED = "disabled";

    /** @var string */
    const STATUS_NOT_SUPPORTED = "not_supported";

    /**
     * Успешно
     *
     * @return bool
     */
    public function isSuccess();

    /**
     * Курс валюты
     *
     * @return float|null
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

    /**
     * Доступна
     *
     * @return bool
     */
    public function isSupported();
}