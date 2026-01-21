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
 * Информация по пользователю
 *
 * Class UserDetailTest
 */
class UserDetailTest extends TestCase
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
                "id": 2,
                "status": "Active",
                "balance": 85.00,
                "currency": "USD"
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
        $response = (new CryptoScanClient($auth, $provider))->userDetail();

        $this->assertTrue($response->isSuccess());
        $this->assertEquals(2, $response->getId());
        $this->assertEquals('Active', $response->getStatus());
        $this->assertEquals(85.00, $response->getBalance());
        $this->assertEquals('USD', $response->getCurrency());
    }
}
