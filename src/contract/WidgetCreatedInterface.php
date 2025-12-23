<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.06.2023
 * Time: 19:37
 */

namespace cryptoscan\contract;


/**
 * Созданный виджет
 *
 * Class WidgetCreatedInterface
 * @package cryptoscan\contract
 */
interface WidgetCreatedInterface
{
    /**
     * Успешно
     *
     * @return bool
     */
    public function isSuccess();

    /**
     * ID инвойса
     *
     * @return int
     */
    public function getId();

    /**
     * Итоговая сумма к оплате
     *
     * @return string|null
     */
    public function getFinalAmount();

    /**
     * Кошелёк для оплаты
     *
     * @return string|null
     */
    public function getWallet();

    /**
     * Время, когда платеж станет просрочен
     *
     * @return int
     */
    public function getExpireAt();

    /**
     * URL страницы виджета
     *
     * @return string
     */
    public function getWidgetUrl();

    /**
     * Криптовалюта оплаты
     *
     * @return string|null
     */
    public function getCryptocurrency();

    /**
     * Сеть (blockchain) оплаты
     *
     * @return string|null
     */
    public function getNetwork();
}