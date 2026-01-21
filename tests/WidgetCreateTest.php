<?php

use cryptoscan\command\WidgetCreate;
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
 * Создание виджета
 *
 * Class WidgetCreateTest
 */
class WidgetCreateTest extends TestCase
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
                "id": "523654",
                "final_amount": "133.23",
                "wallet": "TsdfsdfFDSGFHFGDGBFDGFG",
                "expire_at": "1677422490",
                "widget_url": "https://cryptoscan.one/payment/69908b3b-ac70-4652-9ca2-877e348a2dbe"
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

        $command = new WidgetCreate(
            10,
            '123'
        );
        $auth = AuthFactory::signature('public', 'private');
        $provider = ProviderFactory::http($mockClient);
        $response = (new CryptoScanClient($auth, $provider))->widgetCreate($command);

        $this->assertTrue($response->isSuccess());
        $this->assertEquals('523654', $response->getId());
        $this->assertEquals('133.23', $response->getFinalAmount());
        $this->assertEquals('TsdfsdfFDSGFHFGDGBFDGFG', $response->getWallet());
        $this->assertEquals('1677422490', $response->getExpireAt());
        $this->assertEquals('https://cryptoscan.one/payment/69908b3b-ac70-4652-9ca2-877e348a2dbe', $response->getWidgetUrl());
    }
}
