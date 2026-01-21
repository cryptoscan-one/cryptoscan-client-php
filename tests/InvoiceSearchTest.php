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
 * Поиск инвойсов
 *
 * Class InvoiceSearchTest
 */
class InvoiceSearchTest extends TestCase
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
              "data": [
                    {
                        "id": 32,
                        "wallet": "TsdfsdfFDSGFHFGDGBFDGFG",
                        "payer_wallet": "ThfghfghKNJLNJK",
                        "transaction_id": null,
                        "final_amount": 10.54,
                        "requested_amount": "10.53",
                        "status": "completed",
                        "client_reference_id": "287",
                        "metadata": "qwerty",
                        "created_at": 1678991717,
                        "paid_at": null,
                        "expire_at": 1678993517
                    }
                ]
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
        $response = (new CryptoScanClient($auth, $provider))->invoiceSearch(123456);
        $item = current($response->getItems());

        $this->assertCount(1, $response->getItems());
        $this->assertTrue($response->isSuccess());

        $this->assertEquals('32', $item->getId());
        $this->assertEquals('ThfghfghKNJLNJK', $item->getPayerWallet());
        $this->assertEquals('TsdfsdfFDSGFHFGDGBFDGFG', $item->getWallet());
        $this->assertNull($item->getTransactionId());
        $this->assertEquals('10.54', $item->getFinalAmount());
        $this->assertEquals('10.53', $item->getRequestedAmount());
        $this->assertEquals('completed', $item->getStatus());
        $this->assertEquals('287', $item->getClientReferenceId());
        $this->assertEquals('qwerty', $item->getMetadata());
        $this->assertEquals('1678991717', $item->getCreatedAt());
        $this->assertNull($item->getPaidAt());
        $this->assertEquals('1678993517', $item->getExpireAt());
    }
}
