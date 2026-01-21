<?php

use cryptoscan\entity\Authorize;
use cryptoscan\factory\AuthFactory;
use PHPUnit\Framework\TestCase;

/**
 * Тест проверки авторизации
 *
 * Class AuthorizeTest
 * @package ${NAMESPACE}
 */
class AuthorizeTest extends TestCase
{
    /**
     * @return void
     */
    public function testSuccessPrivate()
    {
        $auth = AuthFactory::privateKey('public', 'private');
        $authorize = new Authorize('public', 'private');
        $data = [
            'id' => 1,
            'wallet' => 'TsdfsdfFDSGFHFGDGBFDGFG',
            'final_amount' => 10.5,
            'requested_amount' => 10.3,
        ];

        $isSuccess = $auth->isAccessConfirmed($authorize, $data);
        $this->assertTrue($isSuccess);
    }

    /**
     * @return void
     */
    public function testFailurePrivate()
    {
        $auth = AuthFactory::privateKey('public', 'private');
        $authorize = new Authorize('public2', 'private');
        $data = [
            'id' => 1,
            'wallet' => 'TsdfsdfFDSGFHFGDGBFDGFG',
            'final_amount' => 10.5,
            'requested_amount' => 10.3,
        ];

        $isSuccess = $auth->isAccessConfirmed($authorize, $data);
        $this->assertFalse($isSuccess);

        $auth = AuthFactory::privateKey('public', 'private');
        $authorize = new Authorize('public', 'private2');
        $data = [
            'id' => 1,
            'wallet' => 'TsdfsdfFDSGFHFGDGBFDGFG',
            'final_amount' => 10.5,
            'requested_amount' => 10.3,
        ];

        $isSuccess = $auth->isAccessConfirmed($authorize, $data);
        $this->assertFalse($isSuccess);
    }

    /**
     * @return void
     */
    public function testSuccessSignature()
    {
        $auth = AuthFactory::signature('public', 'private');
        $authorize = new Authorize('public', '4a746311f8d20da3c0d432ecd36bcf3fb17d501ab3c301bc2610ab0171baa5be');
        $data = [
            'id' => 1,
            'wallet' => 'TsdfsdfFDSGFHFGDGBFDGFG',
            'final_amount' => 10.5,
            'requested_amount' => 10.3,
        ];

        $isSuccess = $auth->isAccessConfirmed($authorize, $data);
        $this->assertTrue($isSuccess);
    }

    /**
     * @return void
     */
    public function testFailureSignature()
    {
        $auth = AuthFactory::signature('public', 'private');
        $authorize = new Authorize('public', 'failure');
        $data = [
            'id' => 1,
            'wallet' => 'TsdfsdfFDSGFHFGDGBFDGFG',
            'final_amount' => 10.5,
            'requested_amount' => 10.3,
        ];

        $isSuccess = $auth->isAccessConfirmed($authorize, $data);
        $this->assertFalse($isSuccess);
    }
}
