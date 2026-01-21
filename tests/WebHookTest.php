<?php

use cryptoscan\exception\AuthFailureException;
use cryptoscan\factory\AuthFactory;
use cryptoscan\webhook\WebHookExpiredMessage;
use cryptoscan\webhook\WebHookPaidMessage;
use cryptoscan\webhook\WebHookRequest;
use cryptoscan\WebHookHandler;
use PHPUnit\Framework\TestCase;

/**
 * Получение данных WebHook
 *
 * Class WebHookTest
 * @package ${NAMESPACE}
 */
class WebHookTest extends TestCase
{
    /**
     * @return void
     */
    public function testPaid()
    {
        $headers = [
            'public-key' => 'public',
            'signature' => 'private',
        ];

        $data = [
            'event_type' => 'paid',
            'retry_count' => 3,
            'data' => [
                'id' => 1,
                'wallet' => 'TsdfsdfFDSGFHFGDGBFDGFG',
                'payer_wallet' => 'TsdfsdfFDSGFHFGDGBFDGFG',
                'transaction_id' => '123',
                'final_amount' => 10.5,
                'requested_amount' => 10.3,
                'status' => 'completed',
                'client_reference_id' => '12345',
                'metadata' => 'example',
                'created_at' => 1678993517,
                'paid_at' => 1678993517,
                'expire_at' => 1678993517,
            ],
        ];

        $auth = AuthFactory::privateKey('public', 'private');
        $message = new WebHookRequest($headers, $data);
        $webHook = new WebHookHandler($auth);

        $result = $webHook->handle($message);

        $this->assertInstanceOf(WebHookPaidMessage::class, $result);
        $this->assertEquals('paid', $result->getEventType());
        $this->assertEquals('3', $result->getRetryCount());
        $this->assertEquals('1', $result->getId());
        $this->assertEquals('TsdfsdfFDSGFHFGDGBFDGFG', $result->getWallet());
        $this->assertEquals('TsdfsdfFDSGFHFGDGBFDGFG', $result->getPayerWallet());
        $this->assertEquals('123', $result->getTransactionId());
        $this->assertEquals('10.5', $result->getFinalAmount());
        $this->assertEquals('10.3', $result->getRequestedAmount());
        $this->assertEquals('completed', $result->getStatus());
        $this->assertEquals('12345', $result->getClientReferenceId());
        $this->assertEquals('example', $result->getMetadata());
        $this->assertEquals('1678993517', $result->getCreatedAt());
        $this->assertEquals('1678993517', $result->getPaidAt());
        $this->assertEquals('1678993517', $result->getExpireAt());
    }

    /**
     * @return void
     */
    public function testExpired()
    {
        $headers = [
            'public-key' => 'public',
            'signature' => 'private',
        ];

        $data = [
            'event_type' => 'expired',
            'retry_count' => 3,
            'data' => [
                'id' => 1,
                'wallet' => 'TsdfsdfFDSGFHFGDGBFDGFG',
                'final_amount' => 10.5,
                'requested_amount' => 10.3,
                'status' => 'completed',
                'client_reference_id' => '12345',
                'metadata' => 'example',
                'created_at' => 1678993517,
                'expire_at' => 1678993517,
            ],
        ];

        $auth = AuthFactory::privateKey('public', 'private');
        $message = new WebHookRequest($headers, $data);
        $webHook = new WebHookHandler($auth);

        $result = $webHook->handle($message);

        $this->assertInstanceOf(WebHookExpiredMessage::class, $result);
        $this->assertEquals('expired', $result->getEventType());
        $this->assertEquals('3', $result->getRetryCount());
        $this->assertEquals('1', $result->getId());
        $this->assertEquals('TsdfsdfFDSGFHFGDGBFDGFG', $result->getWallet());
        $this->assertEquals('10.5', $result->getFinalAmount());
        $this->assertEquals('10.3', $result->getRequestedAmount());
        $this->assertEquals('completed', $result->getStatus());
        $this->assertEquals('12345', $result->getClientReferenceId());
        $this->assertEquals('example', $result->getMetadata());
        $this->assertEquals('1678993517', $result->getCreatedAt());
        $this->assertEquals('1678993517', $result->getExpireAt());
    }

    /**
     * @return void
     */
    public function testAccessDeniedPrivate()
    {
        $this->expectException(AuthFailureException::class);
        $headers = [
            'public-key' => 'public2',
            'signature' => 'private',
        ];

        $data = [
            'event_type' => 'expired',
            'retry_count' => 3,
            'data' => [],
        ];

        $auth = AuthFactory::privateKey('public', 'private');
        $message = new WebHookRequest($headers, $data);
        $webHook = new WebHookHandler($auth);

        $webHook->handle($message);
    }

    /**
     * @return void
     */
    public function testAccessDeniedSignature()
    {
        $this->expectException(AuthFailureException::class);
        $headers = [
            'public-key' => 'public',
            'signature' => 'qwerty',
        ];

        $data = [
            'event_type' => 'expired',
            'retry_count' => 3,
            'data' => [],
        ];

        $auth = AuthFactory::signature('public', 'private');
        $message = new WebHookRequest($headers, $data);
        $webHook = new WebHookHandler($auth);

        $webHook->handle($message);
    }
}
