<?php

namespace cryptoscan\exception;


use cryptoscan\contract\FailureInterface;

/**
 * Ошибка данных запроса
 *
 * Class InvalidDataException
 * @package cryptoscan\exception
 */
class InvalidDataException extends ClientFailureException
{
    /**
     * @param FailureInterface $failure
     */
    public function __construct(FailureInterface $failure)
    {
        parent::__construct($failure);
        $this->setMessageByErrors();
    }

    /**
     * Изменение текста исключения из списка ошибок
     *
     * @return void
     */
    private function setMessageByErrors()
    {
        $response = $this->getResponse();
        $errors = $response->getErrors();

        if (empty($errors) === true) {
            return;
        }

        $messages = [];
        array_walk(
            $errors,
            static function (array $error) use (&$messages) {
                $messages = array_merge($messages, $error);
            }
        );
        $this->message = implode(' ', $messages);
    }
}
