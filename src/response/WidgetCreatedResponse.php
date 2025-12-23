<?php

namespace cryptoscan\response;

use cryptoscan\contract\WidgetCreatedInterface;


/**
 *
 *
 * Class WidgetCreatedResponse
 * @package cryptoscan\response
 */
class WidgetCreatedResponse extends BaseResponse implements WidgetCreatedInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $finalAmount;

    /**
     * @var string|null
     */
    protected $wallet;

    /**
     * @var int
     */
    protected $expireAt;

    /**
     * @var string
     */
    protected $widgetUrl;

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
    public function getFinalAmount()
    {
        return $this->finalAmount;
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
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * @inheritDoc
     */
    public function getWidgetUrl()
    {
        return $this->widgetUrl;
    }

    /**
     * Криптовалюта оплаты
     *
     * @return string|null
     */
    public function getCryptocurrency()
    {
        return $this->cryptocurrency;
    }

    /**
     * Сеть (blockchain) оплаты
     *
     * @return string|null
     */
    public function getNetwork()
    {
        return $this->network;
    }
}