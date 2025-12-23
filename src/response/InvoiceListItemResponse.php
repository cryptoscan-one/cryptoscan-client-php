<?php

namespace cryptoscan\response;

use cryptoscan\contract\InvoiceListItemInterface;
use cryptoscan\entity\BaseObject;

/**
 * @inheritDoc
 *
 * Class InvoiceListItemResponse
 * @package cryptoscan\response
 */
class InvoiceListItemResponse extends BaseObject implements InvoiceListItemInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string|null
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
     * @var float|null
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
    public $expireAt;

    /**
     * @var string|null
     */
    protected $cryptocurrency;

    /**
     * @var string|null
     */
    protected $network;

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
     * @return string|null
     */
    public function getCryptocurrency()
    {
        return $this->cryptocurrency;
    }

    /**
     * @return string|null
     */
    public function getNetwork()
    {
        return $this->network;
    }
}
