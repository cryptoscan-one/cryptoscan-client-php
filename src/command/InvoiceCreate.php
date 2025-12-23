<?php

namespace cryptoscan\command;

use cryptoscan\entity\Amount;
use cryptoscan\entity\Metadata;
use cryptoscan\factory\EntityFactory;

/**
 * Создание Инвойса
 *
 * Class InvoiceCreate
 * @package cryptoscan\command
 */
class InvoiceCreate
{
    /**
     * Сумма к оплате
     *
     * @var Amount
     */
    private $amount;

    /**
     * Валюта
     *
     * @var string|null
     */
    private $currency;

    /**
     * Криптовалюта, в которой должен быть произведён платёж
     *
     * @var string|null
     */
    private $cryptocurrency;

    /**
     * Сеть (blockchain), в которой должен быть проведён платёж
     *
     * @var string|null
     */
    private $network;

    /**
     * Номер платежа в системе
     *
     * @var string
     */
    private $clientReferenceId;

    /**
     * Произвольная строка
     *
     * @var Metadata|null
     */
    private $metadata;

    /**
     * @param float|Amount $amount
     * @param string $clientReferenceId
     */
    public function __construct($amount, $clientReferenceId)
    {
        $this->amount = EntityFactory::amount($amount);
        $this->clientReferenceId = $clientReferenceId;
    }

    /**
     * @return Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getClientReferenceId()
    {
        return $this->clientReferenceId;
    }

    /**
     * @return Metadata|null
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param string|Metadata|null $metadata
     * @return self
     */
    public function setMetadata($metadata)
    {
        if (empty($metadata) === false) {
            $this->metadata = EntityFactory::metadata($metadata);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     * @return InvoiceCreate
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCryptocurrency()
    {
        return $this->cryptocurrency;
    }

    /**
     * Задаёт значение для криптовалюты платежа
     *
     * @param string|null $cryptocurrency
     * @return $this
     */
    public function setCryptocurrency($cryptocurrency)
    {
        $this->cryptocurrency = $cryptocurrency;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * Задаёт значение для сети, в которой должен быть произведён платёж
     *
     * @param string|null $network
     * @return $this
     */
    public function setNetwork($network)
    {
        $this->network = $network;
        return $this;
    }
}
