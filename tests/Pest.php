<?php

use Resend\Client;
use Resend\Contracts\Transporter;
use Resend\ValueObjects\ApiKey;
use Resend\ValueObjects\Transporter\BaseUri;
use Resend\ValueObjects\Transporter\Headers;
use Resend\ValueObjects\Transporter\Payload;

function mockClient(string $method, string $resource, array $parameters, array $rawHeaders, array|string $response, $methodName = 'request')
{
    /** @var Mockery\MockInterface|Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);

    $transporter
        ->shouldReceive($methodName)
        ->once()
        ->withArgs(function (Payload $payload) use ($method, $resource, $parameters, $rawHeaders) {
            $baseUri = BaseUri::from('api.resend.com');
            $headers = Headers::withAuthorization(ApiKey::from('foo'));

            $request = $payload->toRequest($baseUri, $headers);

            $uri = (string) $request->getUri();
            $pathWithQuery = str_replace('https://' . $request->getUri()->getHost(), '', $uri);

            if ($method === 'POST' || $method === 'PATCH' || $method === 'PUT') {
                $expectedBody = ($parameters === [] || ! array_is_list($parameters))
                    ? json_encode((object) $parameters, JSON_THROW_ON_ERROR)
                    : json_encode($parameters, JSON_THROW_ON_ERROR);

                if ((string) $request->getBody() !== $expectedBody) {
                    return false;
                }
            }

            if (array_key_exists('Idempotency-Key', $rawHeaders)) {
                if (! $request->hasHeader('Idempotency-Key')) {
                    return false;
                }

                if ($request->getHeader('Idempotency-Key')[0] !== $rawHeaders['Idempotency-Key']) {
                    return false;
                }
            }

            return $request->getMethod() === $method
                && $request->getHeader('User-Agent')[0] === 'resend-php/' . Resend::VERSION
                && $pathWithQuery === "/{$resource}";
        })->andReturn($response);

    return new Client($transporter);
}
