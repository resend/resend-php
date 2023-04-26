<?php

use Resend\Client;
use Resend\Contracts\Transporter;
use Resend\ValueObjects\ApiKey;
use Resend\ValueObjects\Transporter\BaseUri;
use Resend\ValueObjects\Transporter\Headers;
use Resend\ValueObjects\Transporter\Payload;

function mockClient(string $method, string $resource, array $parameters, array|string $response, $methodName = 'request')
{
    /** @var \Mockery\MockInterface|\Resend\Contracts\Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);

    $transporter
        ->shouldReceive($methodName)
        ->once()
        ->withArgs(function (Payload $payload) use ($method, $resource) {
            $baseUri = BaseUri::from('api.resend.com');
            $headers = Headers::withAuthorization(ApiKey::from('foo'));

            $request = $payload->toRequest($baseUri, $headers);

            return $request->getMethod() === $method
                && $request->getUri()->getPath() === "/{$resource}";
        })->andReturn($response);

    return new Client($transporter);
}
