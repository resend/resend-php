<?php

namespace Resend\Transporters;

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

        try {
            $response = $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }

        $contents = $response->getBody()->getContents();

        $this->throwIfJsonError($response, $contents);

        try {
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        return $response;
    }

    /**
     * Throw an exception if there is a JSON error.
     */
    protected function throwIfJsonError(ResponseInterface $response, string $contents): void
    {
        if ($response->getStatusCode() < 400) {
            return;
        }

        try {
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

            $errors = ['missing_required_fields', 'missing_required_field', 'missing_api_key', 'invalid_api_key', 'invalid_from_address', 'validation_error', 'not_found', 'method_not_allowed', 'invalid_scope', 'restricted_api_key', 'internal_server_error'];
            if (
                isset($response['error']) ||
                in_array($response['name'], $errors)
            ) {
                throw new ErrorException($response['error'] ?? $response);
            }
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }
    }
}
