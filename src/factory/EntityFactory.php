<?php

namespace cryptoscan\factory;

use cryptoscan\entity\Amount;
use cryptoscan\entity\Authorize;
use cryptoscan\entity\Metadata;

/**
 * Создание сущности
 *
 * Class EntityFactory
 * @package \cryptoscan\factory
 */
class EntityFactory
{
    /**
     * EntityFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * Сумма
     *
     * @param Amount|float|int $value
     * @return Amount
     */
    public static function amount($value)
    {
        return ($value instanceof Amount) === true ?
            $value :
            new Amount($value);
    }

    /**
     * Дополнительная информация
     *
     * @param Metadata|float|int $value
     * @return Metadata
     */
    public static function metadata($value)
    {
        return ($value instanceof Metadata) === true ?
            $value :
            new Metadata($value);
    }

    /**
     * Данные авторизации
     *
     * @param string|null $publicKey
     * @param string|null $credential
     * @return Authorize
     */
    public static function authorize($publicKey, $credential)
    {
        return new Authorize($publicKey, $credential);
    }
}
