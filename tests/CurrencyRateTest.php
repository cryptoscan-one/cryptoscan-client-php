<?php

use cryptoscan\contract\CurrencyRateListInterface;
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
 * Поддерживаемые валюты
 *
 * Class CurrencyRateTest
 */
class CurrencyRateTest extends TestCase
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
                        "currency": "BYN",
                        "rate": 2.52334,
                        "status": "enabled"
                    },
                    {
                        "currency": "EUR",
                        "rate": 0.93574,
                        "status": "enabled"
                    },
                    {
                        "currency": "GBP",
                        "rate": 0.80534,
                        "status": "disabled"
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
        $response = (new CryptoScanClient($auth, $provider))->currencyRate();

        $this->assertInstanceOf(CurrencyRateListInterface::class, $response);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals('enabled', $response->getItems()[0]->getStatus());
        $this->assertEquals('2.52334', $response->getItems()[0]->getRate());
        $this->assertTrue($response->getItems()[0]->isEnabled());
    }
}
