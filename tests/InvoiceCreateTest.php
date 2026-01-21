<?php

use cryptoscan\command\InvoiceCreate;
use cryptoscan\CryptoScanClient;
use cryptoscan\factory\AuthFactory;
use cryptoscan\factory\ProviderFactory;
use cryptoscan\provider\HttpClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Создание инвойса
 *
 * Class InvoiceCreateTest
 */
class InvoiceCreateTest extends TestCase
{
    /**
     * @return void
     * @throws GuzzleException
     */
    public function testSuccess()
    {
        $mockHandler = new MockHandler([
            new Response(200, [], '{
              "success": true,
              "data": {
                "id": "12589",
                "final_amount": "125.69",
                "wallet": "TsdfsdfFDSGFHFGDGBFDGFG",
                "expire_at": "1677422490"
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

        $command = new InvoiceCreate(
            10,
            '123'
        );
        $auth = AuthFactory::signature('public', 'private');
        $provider = ProviderFactory::http($mockClient);
        $response = (new CryptoScanClient($auth, $provider))->invoiceCreate($command);

        $this->assertTrue($response->isSuccess());
        $this->assertEquals('12589', $response->getId());
        $this->assertEquals('125.69', $response->getFinalAmount());
        $this->assertEquals('TsdfsdfFDSGFHFGDGBFDGFG', $response->getWallet());
        $this->assertEquals('1677422490', $response->getExpireAt());
    }
}
