<?php

namespace Resend\Transporters;

use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
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

    public function request(Payload $payload): array
    {
        $request = $payload->toRequest($this->baseUri, $this->headers);

        try {
            $response = $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }

        $contents = (string) $response->getBody();

        try {
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        if (isset($response['error'])) {
            throw new ErrorException($response['error']);
        }

        return $response;
    }
}
