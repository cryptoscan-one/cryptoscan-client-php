<?php

namespace cryptoscan\contract;

/**
 * Запрос с ошибкой
 *
 * Class FailureInterface
 * @package cryptoscan\contract
 */
interface FailureInterface
{
    /**
     * Успешно
     *
     * @return bool
     */
    public function isSuccess();

    /**
     * Наименование
     *
     * @return string|null
     */
    public function getName();

    /**
     * Сообщение
     *
     * @return string|null
     */
    public function getMessage();

    /**
     * Код
     *
     * @return int|null
     */
    public function getCode();

    /**
     * Статус
     *
     * @return int|null
     */
    public function getStatus();

    /**
     * Список ошибок
     *
     * @return array
     */
    public function getErrors();
}