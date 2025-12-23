CryptoScan
=======================================================

[CryptoScan](https://cryptoscan.one) — Принимайте USDT TRC20 на свой личный счёт

- Приватность
- Функциональный API
- Деньги под Вашим контролем

Установка
------------
Устанавливать рекомендуется через composer выполнив:

    composer require cryptoscan-one/cryptoscan-client-php "~1.1.0"

Использование
-----

### Аутентификация

https://cryptoscan.one/developer/index#auth

```php
$publicKey = '...';
$privateKey = '...';

// Аутентификация по приватному ключу
$auth = AuthFactory::privateKey($publicKey, $privateKey);

// Аутентификация по подписи
$auth = AuthFactory::signature($publicKey, $privateKey);
```

### Создание Инвойса

https://cryptoscan.one/developer/index#invoice-creating

```php
$auth = AuthFactory::signature($publicKey, $privateKey);
$client = new CryptoScanClient($auth);

// Стандартный вызов
$command = new InvoiceCreate(10, '123');
$result = $client->invoiceCreate($command);

// Добавление дополнительных данных
$command = new InvoiceCreate(10, '123');
$command
    ->setMetadata('Example text')
    ->setCurrency("EUR")
    ->setCryptocurrency("USDT")
    ->setNetwork("TRC-20");
$result = $client->invoiceCreate($command);
```

### Создание Виджета для Инвойса

https://cryptoscan.one/developer/index#invoice-widget-creating

```php
...
// Стандартный вызов
$command = new WidgetCreate(10, '123');
$result = $client->widgetCreate($command);

// Добавление дополнительных данных
$command
    ->setBackUrl('https://')
    ->setCancelUrl('https://')
    ->setWidgetDescription('Description')
    ->setLang('ru-RU')
    ->setCurrency("EUR");
$result = $client->widgetCreate($command);
```

### Просмотр Инвойса

https://cryptoscan.one/developer/index#invoice-view

```php
...
$invoiceId = 123456;
$result = $client->invoiceDetail($invoiceId);
```

### Поиск Инвойса

https://cryptoscan.one/developer/index#invoice-find

```php
...
$query = 123456;
$result = $client->invoiceSearch($query);
```

### Ручное подтверждение оплаты Инвойса

https://cryptoscan.one/developer/index#invoice-confirm

```php
...
$invoiceId = 123;
$transactionId = '59f89109ec64e9675c8bf34fc733779a9d562d1f37f94ada4fbe0d7db0b629e6';
$command = new InvoiceConfirm($invoiceId, $transactionId);
$result = $client->invoiceConfirm($command);
```

### Просмотр информации о пользователе

https://cryptoscan.one/developer/index#user-info-view

```php
...
$result = $client->userDetail();
```

### Список поддерживаемых валют

https://cryptoscan.one/developer/index#supported-currency-rates

```php
...
$result = $client->currencyRate();
```

### Проверка доступности валюты

https://cryptoscan.one/developer/index#check-currency

```php
...
$result = $client->currencyRateStatus('EUR');
```

Данные ответа
-----

| Модель                          | Экземпляр класса                   | 
|---------------------------------|------------------------------------|
| Созданный инвойс                | InvoiceCreatedInterface            |
| Созданный виджет                | WidgetCreatedInterface             |
| Детальная информация по инвойсу | InvoiceDetailedInterface           |
| Список инвойсов                 | InvoiceListInterface               |
| Подтверждённый вручную инвойс   | InvoiceDetailedInterface           |
| Информация по пользователю      | UserDetailInterface                |
| Поддерживаемые валюты           | CurrencyRateListInterface          |
| Проверка доступности валюты     | CurrencyRateStatusInterface        |

Обработка ошибок
-----

### Исключения

| Модель                     | Экземпляр класса                   | 
|----------------------------|------------------------------------|
| Интерфейс всех исключений  | ClientExceptionInterface           |
| Ошибка передаваемых данных | InvalidDataException               |
| Не корректные данные       | InvalidArgumentException           |
| Ошибка авторизации         | AuthFailureException               |
| Остальные ошибки           | ClientFailureException             |

HTTP клиент
-----

### Использование своего HTTP клиента

По умолчанию запросы отправляются через Guzzle. Для подключения своего HTTP клиента:

```php
// Создание своего HTTP клиента
class MyHTTPClient impliments HttpClientInterface
{
    ...
}
$httpClient = new MyHTTPClient();
// Создание провайдера данных
$provider = ProviderFactory::http($httpClient);
$client = new CryptoScanClient($auth, $provider);
```

WebHook
-----

### Обработка ответа платежа от сервера

```php
// Заголовок переданного запроса
$headers = [
    'public-key' => '...',
    'signature' => '...',
//    'private-key' => '...',
];

// Тело запроса
$data = [
    'event_type' => 'paid',
    'retry_count' => 3,
    ...
];

// Формирование WebHook запроса
$webHookData = new WebHookRequest($headers, $data);

$auth = AuthFactory::privateKey($publicKey, $privateKey);
$webHookHandler = new WebHookHandler($auth);
$message = $webHookHandler->handle($webHookData);
```

### Использование своего способа получения данных

```php
class MyWebHookData impliments WebHookDataInterface
{
    ...
}
$webHookData = new MyWebHookData($headers, $data);
....
```

### Доступные типы сообщений

| Модель                           | Экземпляр класса                   | 
|----------------------------------|------------------------------------|
| Оплаченный платёж                | WebHookPaidMessage                 |
| Просроченный платёж              | WebHookExpiredMessage              |
| Подтверждённый вручную платёж    | WebHookPaidManuallyMessage         |
| Отменённый пользователем платёж  | WebHookCancelledMessage            |
