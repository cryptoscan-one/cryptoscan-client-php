<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.06.2023
 * Time: 13:52
 */

namespace cryptoscan\webhook;

use cryptoscan\entity\BaseObject;
use cryptoscan\exception\InvalidArgumentException;

/**
 * WebHook сообщение
 *
 * Class WebHookMessage
 * @package cryptoscan\webhook
 */
abstract class WebHookMessage extends BaseObject
{
    /**
     * Счёт оплачен
     * @var string
     */
    const EVENT_PAID = 'paid';

    /**
     * Счёт просрочен
     * @var string
     */
    const EVENT_EXPIRED = 'expired';

    /**
     * Оплата счёта подтверждена вручную
     * @var string
     */
    const EVENT_PAID_MANUALLY = 'paid_manually';

    /**
     * Счёт отменен пользователем
     * @var string
     */
    const EVENT_CANCELLED = 'cancelled';

    const EVENT_TYPE_LIST = [
        self::EVENT_PAID,
        self::EVENT_EXPIRED,
        self::EVENT_PAID_MANUALLY,
        self::EVENT_CANCELLED,
    ];

    /**
     * @var string
     */
    protected $eventType;

    /**
     * @var int
     */
    protected $retryCount;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $wallet;

    /**
     * @var float
     */
    protected $finalAmount;

    /**
     * @var float
     */
    protected $requestedAmount;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $clientReferenceId;

    /**
     * @var string|null
     */
    protected $metadata;

    /**
     * @var int
     */
    protected $createdAt;

    /**
     * @var int
     */
    protected $expireAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * @return float
     */
    public function getFinalAmount()
    {
        return $this->finalAmount;
    }

    /**
     * @return float
     */
    public function getRequestedAmount()
    {
        return $this->requestedAmount;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getClientReferenceId()
    {
        return $this->clientReferenceId;
    }

    /**
     * @return string|null
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @return int
     */
    public function getRetryCount()
    {
        return $this->retryCount;
    }

    /**
     * Оплачен
     *
     * @return bool
     */
    public function isPaid()
    {
        return $this->eventType === self::EVENT_PAID;
    }

    /**
     * @param $value
     * @return void
     */
    protected function setEventType($value)
    {
        self::assertEventType($value);
        $this->eventType = $value;
    }

    /**
     * @param $value
     * @return void
     */
    protected function setRetryCount($value)
    {
        self::assertRetryCount($value);
        $this->retryCount = $value;
    }

    /**
     * @param $value
     * @return void
     */
    protected static function assertEventType($value)
    {
        if (empty($value) === true) {
            throw new InvalidArgumentException("EventType can not to be empty");
        }
        if (in_array($value, self::EVENT_TYPE_LIST) === false) {
            throw new InvalidArgumentException("EventType is not valid");
        }
    }

    /**
     * @param $value
     * @return void
     */
    protected static function assertRetryCount($value)
    {
        if (is_integer($value) === false) {
            throw new InvalidArgumentException("RetryCount must be integer");
        }
    }
}