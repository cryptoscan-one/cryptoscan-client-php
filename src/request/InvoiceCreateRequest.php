<?php

namespace cryptoscan\request;

use cryptoscan\command\InvoiceCreate;

/**
 * Запрос на создание инвойса
 *
 * Class InvoiceCreateRequest
 * @package cryptoscan\request
 */
class InvoiceCreateRequest implements HttpRequestInterface
{
    /**
     * @var InvoiceCreate
     */
    private $command;

    /**
     * @param InvoiceCreate $command
     */
    public function __construct(InvoiceCreate $command)
    {
        $this->command = $command;
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return "POST";
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return "invoice";
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        $command = $this->command;
        $metadata = $command->getMetadata();

        return [
            "amount" => $command
                ->getAmount()
                ->getValue(),
            "metadata" => $metadata != null ?
                $metadata->getValue() :
                null,
            "client_reference_id" => $command->getClientReferenceId(),
            "currency" => $command->getCurrency(),
            "cryptocurrency" => $command->getCryptocurrency(),
            "network" => $command->getNetwork(),
        ];
    }
}
