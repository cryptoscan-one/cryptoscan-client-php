<?php

namespace cryptoscan\command;

/**
 * Ручное подтверждение платежа
 *
 * @package cryptoscan\command
 */
class InvoiceConfirm
{
    /**
     * ID инвойса
     *
     * @var int
     */
    private $id;

    /**
     * ID транзакции в сети, указанной в инвойсе (network)
     *
     * @var string
     */
    private $transactionId;

    /**
     * @param int $id
     * @param string $transactionId
     */
    public function __construct($id, $transactionId)
    {
        $this->id = $id;
        $this->transactionId = $transactionId;
    }

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
    public function getTransactionId()
    {
        return $this->transactionId;
    }
}