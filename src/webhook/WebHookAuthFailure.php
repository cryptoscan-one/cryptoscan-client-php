<?php

namespace cryptoscan\webhook;

use cryptoscan\contract\FailureInterface;

/**
 * Ошибка проверки данных авторизации через WebHook
 *
 * Class WebHookAuthFailure
 * @package cryptoscan\webhook
 */
class WebHookAuthFailure implements FailureInterface
{
    /**
     * @inheritDoc
     */
    public function isSuccess()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'Unauthorized';
    }

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        return 'Your request was made with invalid credentials';
    }

    /**
     * @inheritDoc
     */
    public function getCode()
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return 401;
    }

    /**
     * @inheritDoc
     */
    public function getErrors()
    {
        return [];
    }
}