<?php

namespace cryptoscan\response;

use cryptoscan\entity\BaseObject;

/**
 * Ответ с подтверждением
 *
 * Class ConfirmedBaseResponse
 * @package cryptoscan\response
 */
abstract class BaseResponse extends BaseObject
{
    /**
     * Успешно
     *
     * @var bool
     */
    protected $success;

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }
}
