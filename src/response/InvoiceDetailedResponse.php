<?php

namespace cryptoscan\response;

use cryptoscan\contract\InvoiceDetailedInterface;

/**
 * @inheritDoc
 *
 * Class InvoiceDetailedResponse
 * @package cryptoscan\response
 */
class InvoiceDetailedResponse extends BaseResponse implements InvoiceDetailedInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $wallet;

    /**
     * @var string|null
     */
    protected $payerWallet;

    /**
     * @var string|null
     */
    protected $transactionId;

    /**
     * @var float
     */
    protected $requestedAmount;

    /**
     * @var float
     */
    protected $finalAmount;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $clientReferenceId;

    /**
     * @var string|null
     */
    protected $metadata;

    /**
     * @var int
     */
    protected $createdAt;

    /**
     * @var int|null
     */
    protected $paidAt;

    /**
     * @var int
     */
    protected $expireAt;

    /**
     * @var string|null
     */
    protected $sourceCurrency;

    /**
     * @var float|null
     */
    protected $sourceAmount;

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * @inheritDoc
     */
    public function getPayerWallet()
    {
        return $this->payerWallet;
    }

    /**
     * @inheritDoc
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @inheritDoc
     */
    public function getRequestedAmount()
    {
        return $this->requestedAmount;
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    public function getClientReferenceId()
    {
        return $this->clientReferenceId;
    }

    /**
     * @inheritDoc
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @inheritDoc
     */
    public function getPaidAt()
    {
        return $this->paidAt;
    }

    /**
     * @inheritDoc
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * @inheritDoc
     */
    public function getFinalAmount()
    {
        return $this->finalAmount;
    }

    /**
     * @inheritDoc
     */
    public function getSourceCurrency()
    {
        return $this->sourceCurrency;
    }

    /**
     * @inheritDoc
     */
    public function getSourceAmount()
    {
        return $this->sourceAmount;
    }
}