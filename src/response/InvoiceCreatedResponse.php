<?php

namespace cryptoscan\response;

use cryptoscan\contract\InvoiceCreatedInterface;

/**
 * @inheritDoc
 *
 * Class InvoiceCreatedResponse
 * @package cryptoscan\response
 */
class InvoiceCreatedResponse extends BaseResponse implements InvoiceCreatedInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $finalAmount;

    /**
     * @var string
     */
    protected $wallet;

    /**
     * @var int
     */
    protected $expireAt;

    /**
     * @var string
     */
    protected $cryptocurrency;

    /**
     * @var string
     */
    protected $network;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFinalAmount()
    {
        return $this->finalAmount;
    }

    /**
     * @return string
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * @return int
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * Криптовалюта оплаты
     *
     * @return string
     */
    public function getCryptocurrency()
    {
        return $this->cryptocurrency;
    }

    /**
     * Сеть (blockchain) оплаты
     *
     * @return string
     */
    public function getNetwork()
    {
        return $this->network;
    }
}
