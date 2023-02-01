<?php

use Resend\Client;
use Resend\Contracts\Transporter;

function mockClient(string $method, string $resource, array $parameters, array|string $response, $methodName = 'request')
{
    /** @var \Mockery\MockInterface|\Resend\Contracts\Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);

    $transporter
        ->shouldReceive($methodName)
        ->once()
        ->andReturn($response);

    return new Client($transporter);
}
