<?php

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Resend\Enums\Transporter\ContentType;
use Resend\Transporters\HttpTransporter;
use Resend\ValueObjects\ApiKey;
use Resend\ValueObjects\Transporter\BaseUri;
use Resend\ValueObjects\Transporter\Headers;
use Resend\ValueObjects\Transporter\Payload;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);

    $apiKey = ApiKey::from('foo');

    $this->http = new HttpTransporter(
        $this->client,
        BaseUri::from('api.resend.com'),
        Headers::withAuthorization($apiKey)->withContentType(ContentType::JSON)
    );
});

test('request', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);
    $response = new Response(200, [], json_encode([
        'foo',
    ]));

    $this->client
         ->shouldReceive('sendRequest')
         ->once()
         ->withArgs(function (Request $request) {
             expect($request->getMethod())->toBe('POST')
                ->and($request->getUri())
                ->getHost()->toBe('api.resend.com')
                ->getScheme()->toBe('https')
                ->getPath()->toBe('/email');

             return true;
         })->andReturn($response);

    $this->http->request($payload);
});
