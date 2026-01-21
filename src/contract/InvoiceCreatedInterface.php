<?php

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
