<?php

namespace cryptoscan\factory;

use cryptoscan\exception\InvalidArgumentException;
use cryptoscan\webhook\WebHookCancelledMessage;
use cryptoscan\webhook\WebHookMessage;
use cryptoscan\webhook\WebHookExpiredMessage;
use cryptoscan\webhook\WebHookPaidManuallyMessage;
use cryptoscan\webhook\WebHookPaidMessage;
use cryptoscan\webhook\WebHookDataInterface;

/**
 * Создание события платежа WebHook
 *
 * Class WebHookMessageFactory
 * @package \cryptoscan\factory
 */
class WebHookMessageFactory
{
    const MESSAGES_MAP = [
        WebHookMessage::EVENT_PAID => WebHookPaidMessage::class,
        WebHookMessage::EVENT_EXPIRED => WebHookExpiredMessage::class,
        WebHookMessage::EVENT_PAID_MANUALLY => WebHookPaidManuallyMessage::class,
        WebHookMessage::EVENT_CANCELLED => WebHookCancelledMessage::class,
    ];

    /**
     * WebHookFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * Создание по сообщению
     *
     * @param WebHookDataInterface $request
     * @return WebHookMessage
     */
    public static function createByRequest(WebHookDataInterface $request)
    {
        $data = $request->getData();
        $eventType = $request->getEventType();

        if (!in_array($eventType, WebHookMessage::EVENT_TYPE_LIST)) {
            throw new InvalidArgumentException("EventType is not valid");
        }

        $messageClass = self::MESSAGES_MAP[$eventType];
        return new $messageClass($data);
    }
}
