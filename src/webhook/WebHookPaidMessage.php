<?php

namespace cryptoscan\webhook;

/**
 * Оплаченный платеж
 *
 * Class WebHookPaid
 * @package cryptoscan\webhook
 */
class WebHookPaidMessage extends WebHookMessage
{
    /**
     * @var string
     */
    protected $payerWallet;

    /**
     * @var string
     */
    protected $transactionId;

    /**
     * @var int
     */
    protected $paidAt;

    /**
     * @var string|null
     */
    protected $sourceCurrency;

    /**
     * @var float|null
     */
    protected $sourceAmount;

    /**
     * @return string
     */
    public function getPayerWallet()
    {
        return $this->payerWallet;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @return int
     */
    public function getPaidAt()
    {
        return $this->paidAt;
    }

    /**
     * @return string|null
     */
    public function getSourceCurrency()
    {
        return $this->sourceCurrency;
    }

    /**
     * @return float|null
     */
    public function getSourceAmount()
    {
        return $this->sourceAmount;
    }
}