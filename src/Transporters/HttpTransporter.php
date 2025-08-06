<?php

namespace Resend\Transporters;

use Closure;
use GuzzleHttp\Exception\ClientException;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Resend\Contracts\Transporter;
use Resend\Exceptions\ErrorException;
use Resend\Exceptions\TransporterException;
use Resend\Exceptions\UnserializableResponse;
use Resend\ValueObjects\Transporter\BaseUri;
use Resend\ValueObjects\Transporter\Headers;
use Resend\ValueObjects\Transporter\Payload;

class HttpTransporter implements Transporter
{
    /**
     * Create a new HTTP Transporter instance.
     */
    public function __construct(
        private readonly ClientInterface $client,
        private readonly BaseUri $baseUri,
        private readonly Headers $headers,
    ) {
        //
    }

    /**
     * Sends a request to the Resend API.
     *
     * @return array<array-key, mixed>
     *
     * @throws ErrorException|TransporterException|UnserializableResponse
     */
    public function request(Payload $payload): array
    {
        $request = $payload->toRequest($this->baseUri, $this->headers);

        $response = $this->sendRequest(fn () => $this->client->sendRequest($request));
        $contents = $response->getBody()->getContents();
        $contentType = $response->getHeaderLine('Content-Type');

        $this->throwIfJsonError($response, $contents);

        // Only decode as JSON if appropriate
        if (! str_contains($contentType, 'application/json')) {
            throw new UnserializableResponse(
                new JsonException(
                    "Unexpected Content-Type '{$contentType}'. Response body: " . substr($contents, 0, 200)
                ),
                $contents
            );
        }

        if (trim($contents) === '') {
            throw new UnserializableResponse(
                new JsonException('Empty response body'),
                $contents
            );
        }

        try {
            $data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        return $data;
    }

    /**
     * Send the given request callable.
     */
    private function sendRequest(Closure $callable): ResponseInterface
    {
        try {
            return $callable();
        } catch (ClientExceptionInterface $clientException) {
            if ($clientException instanceof ClientException) {
                $this->throwIfJsonError($clientException->getResponse(), $clientException->getResponse()->getBody()->getContents());
            }

            throw new TransporterException($clientException);
        }
    }

    /**
     * Throw an exception if there is a JSON error.
     */
    protected function throwIfJsonError(ResponseInterface $response, string $contents): void
    {
        if ($response->getStatusCode() < 400) {
            return;
        }

        // Only handle JSON content types...
        if (! str_contains($response->getHeaderLine('Content-Type'), 'application/json')) {
            return;
        }

        try {
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

            if (
                isset($response['error']) ||
                (isset($response['name']) && $this->isResendError($response['name']))
            ) {
                $error = $response['error'] ?? $response;

                if (! is_array($error)) {
                    $error = ['message' => is_string($error) ? $error : json_encode($error)];
                }

                throw new ErrorException($error);
            }
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException, $contents);
        }
    }

    /**
     * Determine if the given error name is a Resend error.
     */
    protected function isResendError(string $errorName): bool
    {
        $errors = [
            'application_error',
            'concurrent_idempotent_requests',
            'daily_quota_exceeded',
            'invalid_attachment',
            'invalid_idempotency_key',
            'invalid_idempotent_request',
            'missing_api_key',
            'missing_required_field',
            'not_found',
            'rate_limit_exceeded',
            'restricted_api_key',
            'security_error',
            'validation_error',
        ];

        return in_array($errorName, $errors);
    }
}
