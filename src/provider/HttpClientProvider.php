<?php

namespace cryptoscan\provider;

use cryptoscan\command\InvoiceConfirm;
use cryptoscan\command\InvoiceCreate;
use cryptoscan\command\WidgetCreate;
use cryptoscan\contract\AuthCredentialsInterface;
use cryptoscan\factory\HttpMessageFactory;
use cryptoscan\factory\ResponseExceptionFactory;
use cryptoscan\request\HttpRequestInterface;
use cryptoscan\response\FailureResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * HTTP провайдер данных
 *
 * Class CryptoScanHttpProvider
 * @package cryptoscan\provider
 */
class HttpClientProvider implements ApiProviderInterface
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var AuthCredentialsInterface|null
     */
    private $authCredentials;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @inheritDoc
     */
    public function invoiceCreate(InvoiceCreate $command)
    {
        $request = HttpMessageFactory::invoiceCreate($command);
        $response = $this->safeRequest($request);

        return HttpMessageFactory::invoiceCreated($response);
    }

    /**
     * @inheritDoc
     */
    public function widgetCreate(WidgetCreate $command)
    {
        $request = HttpMessageFactory::widgetCreate($command);
        $response = $this->safeRequest($request);

        return HttpMessageFactory::widgetCreated($response);
    }

    /**
     * @inheritDoc
     */
    public function invoiceDetail($id)
    {
        $request = HttpMessageFactory::invoiceDetail($id);
        $response = $this->safeRequest($request);

        return HttpMessageFactory::invoiceDetailed($response);
    }

    /**
     * @inheritDoc
     */
    public function invoiceSearch($query)
    {
        $request = HttpMessageFactory::invoiceSearch($query);
        $response = $this->safeRequest($request);

        return HttpMessageFactory::invoiceList($response);
    }

    /**
     * @inheritDoc
     */
    public function invoiceConfirm(InvoiceConfirm $command)
    {
        $request = HttpMessageFactory::invoiceConfirm($command);
        $response = $this->safeRequest($request);

        return HttpMessageFactory::invoiceConfirmed($response);
    }

    /**
     * @inheritDoc
     */
    public function userDetail()
    {
        $request = HttpMessageFactory::userDetail();
        $response = $this->safeRequest($request);

        return HttpMessageFactory::userDetailed($response);
    }

    /**
     * @inheritDoc
     */
    public function currencyRate()
    {
        $request = HttpMessageFactory::currencyRate();
        $response = $this->safeRequest($request);

        return HttpMessageFactory::currencyRateResult($response);
    }

    /**
     * @inheritDoc
     */
    public function currencyRateStatus($currency)
    {
        $request = HttpMessageFactory::currencyRateStatus($currency);
        $response = $this->safeRequest($request);

        return HttpMessageFactory::currencyRateStatusResult($response);
    }

    /**
     * @param HttpRequestInterface $request
     * @return ResponseInterface
     */
    private function safeRequest(HttpRequestInterface $request)
    {
        $response = $this->request($request);

        if (
            $response->getStatusCode() >= 200 &&
            $response->getStatusCode() < 400
        ) {
            return $response;
        }
        $failure = FailureResponse::instanceByResponse($response);

        throw ResponseExceptionFactory::createByResponse($response, $failure);
    }

    /**
     * @param HttpRequestInterface $request
     * @return ResponseInterface
     */
    private function request(HttpRequestInterface $request)
    {
        $client = $this->httpClient;
        $credentials = $this->authCredentials;
        $body = $request->getBody();

        $headers = [
            'public-key' => $credentials->getPublicKey(),
            $credentials->getAuthType() => $credentials->getAuthCredentials($body),
        ];

        return $client->sendRequest(
            $request->getMethod(),
            $request->getUri(),
            $headers,
            $body
        );
    }

    /**
     * @inheritDoc
     */
    public function setAuthCredentials(AuthCredentialsInterface $credentials)
    {
        $this->authCredentials = $credentials;
    }
}
