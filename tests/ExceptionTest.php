<?php

use cryptoscan\command\InvoiceCreate;
use cryptoscan\CryptoScanClient;
use cryptoscan\exception\InvalidDataException;
use cryptoscan\factory\AuthFactory;
use cryptoscan\factory\ProviderFactory;
use cryptoscan\provider\HttpClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Проверка исключений
 *
 * Class ExceptionTest
 * @package cryptoscan\exception
 */
class ExceptionTest extends TestCase
{
    /**
     * Ошибка параметров
     *
     * @return void
     * @throws GuzzleException
     */
    public function testBadRequestType()
    {
        $this->expectException(InvalidDataException::class);

        $mockHandler = new MockHandler([
            new Response(400, [], '{
                "success": false,
                "data": {
                    "message": "Invalid request data",
                    "errors": {
                        "client_reference_id": [
                            "Client Reference Id \"2222\" has already been taken."
                        ]
                    }
                }
            }'),
        ]);
        $client = new Client(['handler' => $mockHandler]);

        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendRequest')
            ->willReturn($client->request('POST', '/'));
        $command = new InvoiceCreate(10, '2222');
        $auth = AuthFactory::signature('public', 'private');
        $provider = ProviderFactory::http($mockClient);
        (new CryptoScanClient($auth, $provider))->invoiceCreate($command);
    }

    /**
     * Ошибка параметров
     *
     * @return void
     * @throws GuzzleException
     */
    public function testBadRequestMessage()
    {
        $mockHandler = new MockHandler([
            new Response(400, [], '{
                "success": false,
                "data": {
                    "message": "Invalid request data",
                    "errors": {
                        "client_reference_id": [
                            "Client Reference Id \"2222\" has already been taken."
                        ]
                    }
                }
            }'),
        ]);
        $client = new Client(['handler' => $mockHandler]);

        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendRequest')
            ->willReturn($client->request('POST', '/'));
        $command = new InvoiceCreate(10, '2222');
        $auth = AuthFactory::signature('public', 'private');
        $provider = ProviderFactory::http($mockClient);

        try {
            (new CryptoScanClient($auth, $provider))->invoiceCreate($command);
        } catch (InvalidDataException $exception) {
            $this->assertEquals('Client Reference Id "2222" has already been taken.', $exception->getMessage());
        }
    }

    /**
     * Проверка нескольких сообщений
     *
     * @return void
     * @throws GuzzleException
     */
    public function testBadRequestMessageMultiple()
    {
        $mockHandler = new MockHandler([
            new Response(400, [], '{
                "success": false,
                "data": {
                    "message": "Invalid request data",
                    "errors": {
                        "client_reference_id": [
                            "Error 1.",
                            "Error 2."
                        ]
                    }
                }
            }'),
        ]);
        $client = new Client(['handler' => $mockHandler]);

        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendRequest')
            ->willReturn($client->request('POST', '/'));
        $command = new InvoiceCreate(10, '2222');
        $auth = AuthFactory::signature('public', 'private');
        $provider = ProviderFactory::http($mockClient);

        try {
            (new CryptoScanClient($auth, $provider))->invoiceCreate($command);
        } catch (InvalidDataException $exception) {
            $this->assertEquals('Error 1. Error 2.', $exception->getMessage());
        }
    }

    /**
     * Проверка нескольких полей и сообщений
     *
     * @return void
     * @throws GuzzleException
     */
    public function testBadRequestMessageMultipleFields()
    {
        $mockHandler = new MockHandler([
            new Response(400, [], '{
                "success": false,
                "data": {
                    "message": "Invalid request data",
                    "errors": {
                        "id": [
                            "Message 1.",
                            "Message 2."
                        ],
                        "client_reference_id": [
                            "Error 1.",
                            "Error 2."
                        ]
                    }
                }
            }'),
        ]);
        $client = new Client(['handler' => $mockHandler]);

        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendRequest')
            ->willReturn($client->request('POST', '/'));
        $command = new InvoiceCreate(10, '2222');
        $auth = AuthFactory::signature('public', 'private');
        $provider = ProviderFactory::http($mockClient);

        try {
            (new CryptoScanClient($auth, $provider))->invoiceCreate($command);
        } catch (InvalidDataException $exception) {
            $this->assertEquals('Message 1. Message 2. Error 1. Error 2.', $exception->getMessage());
        }
    }
}
