<?php

namespace cryptoscan\response;

use cryptoscan\contract\UserDetailInterface;

/**
 * @inheritDoc
 *
 * Class UserDetailedResponse
 * @package cryptoscan\response
 */
class UserDetailedResponse extends BaseResponse implements UserDetailInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var float
     */
    protected $balance;

    /**
     * @var string
     */
    protected $currency;

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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    public function getBalance()
    {
        return $this->balance;
    }

    public function getCurrency()
    {
        return $this->currency;
    }
}