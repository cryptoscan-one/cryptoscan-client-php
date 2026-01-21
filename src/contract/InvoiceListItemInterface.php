<?php

namespace cryptoscan\contract;

/**
 *
 *
 * Class InvoiceListItemInterface
 * @package cryptoscan\contract
 */
interface InvoiceListItemInterface
{
    /**
     * ID инвойса
     *
     * @return int
     */
    public function getId();

    /**
     * ID транзакции в сети
     *
     * @return string|null
     */
    public function getTransactionId();

    /**
     * Итоговая сумма к оплате
     *
     * @return float|null
     */
    public function getFinalAmount();

    /**
     * Кошелёк, куда нужно произвести оплату
     *
     * @return string|null
     */
    public function getWallet();

    /**
     * Кошелёк, с которого произведена оплата
     *
     * @return string|null
     */
    public function getPayerWallet();

    /**
     * Запрашиваемая сумма к оплате
     *
     * @return float
     */
    public function getRequestedAmount();

    /**
     * @return string
     */
    public function getStatus();

    /**
     * Статус платежа
     *
     * @return string
     */
    public function getClientReferenceId();

    /**
     * Дополнительная информация
     *
     * @return string|null
     */
    public function getMetadata();

    /**
     * Время создания платежа
     *
     * @return int
     */
    public function getCreatedAt();

    /**
     * Дата обнаружения оплаты
     *
     * @return int|null
     */
    public function getPaidAt();

    /**
     * Время, когда платеж станет просрочен
     *
     * @return int
     */
    public function getExpireAt();

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
