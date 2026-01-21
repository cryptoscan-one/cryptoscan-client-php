<?php

namespace cryptoscan\contract;

/**
 * Информация по пользователю
 *
 * Class UserDetailInterface
 * @package cryptoscan\contract
 */
interface UserDetailInterface
{
    /**
     * Успешно
     *
     * @return bool
     */
    public function isSuccess();

    /**
     * ID пользователя
     *
     * @return int
     */
    public function getId();

    /**
     * Статус
     *
     * @return string
     */
    public function getStatus();

    /**
     * Баланс
     *
     * @return float
     */
    public function getBalance();

    /**
     * Валюта
     *
     * @return float
     */
    public function getCurrency();
}