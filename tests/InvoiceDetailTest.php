<?php

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
 * Просмотр инвойса
 *
 * Class InvoiceDetailTest
 */
class InvoiceDetailTest extends TestCase
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
                "id": 32,
                "wallet": "TsdfsdfFDSGFHFGDGBFDGFG",
                "payer_wallet": "ThfghfghKNJLNJK",
                "transaction_id": null,
                "source_currency": "EUR",
                "source_amount": 10.2,
                "final_amount": 10.54,
                "requested_amount": "10.53",
                "status": "completed",
                "client_reference_id": "287",
                "metadata": "qwerty",
                "created_at": 1678991717,
                "paid_at": null,
                "expire_at": 1678993517
              }
            }'),
        ]);
        $client = new Client(['handler' => $mockHandler]);

        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendRequest')
            ->willReturn($client->request('GET', '/'));

        $auth = AuthFactory::signature('public', 'private');
        $provider = ProviderFactory::http($mockClient);
        $response = (new CryptoScanClient($auth, $provider))->invoiceDetail(123);

        $this->assertTrue($response->isSuccess());
        $this->assertEquals('32', $response->getId());
        $this->assertEquals('ThfghfghKNJLNJK', $response->getPayerWallet());
        $this->assertEquals('TsdfsdfFDSGFHFGDGBFDGFG', $response->getWallet());
        $this->assertNull($response->getTransactionId());
        $this->assertEquals('10.54', $response->getFinalAmount());
        $this->assertEquals('10.53', $response->getRequestedAmount());
        $this->assertEquals('completed', $response->getStatus());
        $this->assertEquals('287', $response->getClientReferenceId());
        $this->assertEquals('qwerty', $response->getMetadata());
        $this->assertEquals('1678991717', $response->getCreatedAt());
        $this->assertNull($response->getPaidAt());
        $this->assertEquals('1678993517', $response->getExpireAt());
        $this->assertEquals('EUR', $response->getSourceCurrency());
        $this->assertEquals('10.2', $response->getSourceAmount());
    }
}
