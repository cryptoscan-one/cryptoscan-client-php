<?php

namespace cryptoscan\request;

use cryptoscan\command\InvoiceConfirm;

/**
 * Запрос на ручное подтверждение инвойса
 *
 * @package cryptoscan\request
 */
class InvoiceConfirmRequest implements HttpRequestInterface
{
    /**
     * @var InvoiceConfirm
     */
    private $command;

    /**
     * @param InvoiceConfirm $command
     */
    public function __construct(InvoiceConfirm $command)
    {
        $this->command = $command;
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return "PUT";
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return "invoice/confirm/{$this->command->getId()}";
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return ["transactionId" => $this->command->getTransactionId()];
    }
}