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

            if ($request->getMethod() !== $method) {
                throw new Exception("[mockClient] HTTP method mismatch: expected '{$method}', got '{$request->getMethod()}'");
            }

            $userAgent = $request->getHeader('User-Agent')[0] ?? null;
            $expectedUserAgent = 'resend-php/' . (defined('Resend::VERSION') ? Resend::VERSION : 'UNKNOWN');
            if ($userAgent !== $expectedUserAgent) {
                throw new Exception("[mockClient] User-Agent mismatch: expected '{$expectedUserAgent}', got '{$userAgent}'");
            }

            if ($pathWithQuery !== "/{$resource}") {
                throw new Exception("[mockClient] Path mismatch: expected '/{$resource}', got '{$pathWithQuery}'");
            }

            if (in_array($method, ['POST', 'PATCH', 'PUT'], true)) {
                $expectedBody = ($parameters === [] || ! array_is_list($parameters))
                    ? json_encode((object) $parameters, JSON_THROW_ON_ERROR)
                    : json_encode($parameters, JSON_THROW_ON_ERROR);

                $actualBody = (string) $request->getBody();
                if ($actualBody !== $expectedBody) {
                    throw new Exception("[mockClient] Body mismatch:\nExpected: {$expectedBody}\nActual:   {$actualBody}");
                }
            }

            if (array_key_exists('Idempotency-Key', $rawHeaders)) {
                if (! $request->hasHeader('Idempotency-Key')) {
                    throw new Exception('[mockClient] Missing Idempotency-Key header');
                }

                $actualIdempotency = $request->getHeader('Idempotency-Key')[0] ?? null;
                if ($actualIdempotency !== $rawHeaders['Idempotency-Key']) {
                    throw new Exception("[mockClient] Idempotency-Key mismatch: expected '{$rawHeaders['Idempotency-Key']}', got '{$actualIdempotency}'");
                }
            }

            return true;
        })->andReturn($response);

    return new Client($transporter);
}
