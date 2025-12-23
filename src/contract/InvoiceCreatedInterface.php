<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.06.2023
 * Time: 16:50
 */

namespace cryptoscan\contract;


/**
 * Созданный инвойс
 *
 * Class InvoiceCreatedInterface
 * @package cryptoscan\contract
 */
interface InvoiceCreatedInterface
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
     * Сумма платежа
     *
     * @return string
     */
    public function getFinalAmount();

    /**
     * Кошелёк для оплаты
     *
     * @return string
     */
    public function getWallet();

    /**
     * Время, когда платеж станет просрочен
     *
     * @return int
     */
    public function getExpireAt();

    /**
     * Криптовалюта оплаты
     *
     * @return string
     */
    public function getCryptocurrency();

    /**
     * Сеть (blockchain) оплаты
     *
     * @return string
     */
    public function getNetwork();
}
