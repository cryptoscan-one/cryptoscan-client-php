<?php

use cryptoscan\contract\CurrencyRateStatusInterface;
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
 * Проверка доступности валюты
 *
 * Class CurrencyRateStatusTest
 */
class CurrencyRateStatusTest extends TestCase
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
                "data":{
                    "status":"enabled",
                    "rate":"0.91934000"
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
        $response = (new CryptoScanClient($auth, $provider))->currencyRateStatus("GBP");

        $this->assertInstanceOf(CurrencyRateStatusInterface::class, $response);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals('enabled', $response->getStatus());
        $this->assertEquals('0.91934000', $response->getRate());
        $this->assertTrue($response->isEnabled());
    }
}
