<?php

namespace cryptoscan\webhook;

use cryptoscan\entity\Authorize;
use cryptoscan\factory\EntityFactory;

/**
 * Запрос WebHook по HTTP
 *
 * Class WebHookRequest
 * @package cryptoscan\request
 */
class WebHookRequest implements WebHookDataInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var Authorize
     */
    private $authorize;

    /**
     * @param array $headers
     * @param array $data
     */
    public function __construct(array $headers, array $data)
    {
        $this->setAuthorize($headers);
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function getAuthorize()
    {
        return $this->authorize;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function getEventType()
    {
        return $this->data['event_type'] ?: null;
    }

    /**
     * Установка данных авторизации
     *
     * @param array $headers
     * @return void
     */
    private function setAuthorize(array $headers)
    {
        $publicKey = array_key_exists('public-key', $headers) === true ?
            $headers['public-key'] :
            null;

        if (
            array_key_exists('signature', $headers) === true &&
            empty($headers['signature']) === false
        ) {
            $credentials = $headers['signature'];
        } elseif (
            array_key_exists('private-key', $headers) === true &&
            empty($headers['private-key']) === false
        ) {
            $credentials = $headers['private-key'];
        } else {
            $credentials = null;
        }

        $this->authorize = EntityFactory::authorize($publicKey, $credentials);
    }
}