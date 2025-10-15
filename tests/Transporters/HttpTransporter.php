<?php

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Resend\Enums\Transporter\ContentType;
use Resend\Exceptions\ErrorException;
use Resend\Exceptions\TransporterException;
use Resend\Exceptions\UnserializableResponse;
use Resend\Transporters\HttpTransporter;
use Resend\ValueObjects\ApiKey;
use Resend\ValueObjects\Transporter\BaseUri;
use Resend\ValueObjects\Transporter\Headers;
use Resend\ValueObjects\Transporter\Payload;

beforeEach(function () {
    /** @var ClientInterface|Mockery\MockInterface */
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
    $response = new Response(
        200,
        ['Content-Type' => 'application/json'],
        json_encode(['foo'])
    );

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

test('request response', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);
    $response = new Response(
        200,
        ['Content-Type' => 'application/json'],
        json_encode([
            'id' => 'test_123',
            'to' => 'test@resend.com',
        ])
    );

    $this->client
         ->shouldReceive('sendRequest')
         ->once()
         ->andReturn($response);

    $response = $this->http->request($payload);

    expect($response);
});

test('request can handle string errors', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);
    $response = new Response(
        401,
        ['Content-Type' => 'text/plain'],
        'Unauthorized'
    );

    $this->client
         ->shouldReceive('sendRequest')
         ->once()
         ->andReturn($response);

    $this->http->request($payload);
})->throws(UnserializableResponse::class, "Unexpected Content-Type 'text/plain'. Response body: Unauthorized");

test('request can handle client errors', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));

    $this->client
         ->shouldReceive('sendRequest')
         ->once()
         ->andThrow(new ConnectException('Could not resolve host.', $payload->toRequest($baseUri, $headers)));

    expect(fn () => $this->http->request($payload))->toThrow(function (TransporterException $exception) {
        expect($exception->getMessage())->toBe('Could not resolve host.')
            ->and($exception->getCode())->toBe(0)
            ->and($exception->getPrevious())->toBeInstanceOf(ConnectException::class);
    });
});

test('request can handle serialization errors', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);
    $response = new Response(200, ['content-type' => 'text/plain'], 'err');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->request($payload);
})->throws(UnserializableResponse::class, "Unexpected Content-Type 'text/plain'. Response body: err");

test('request can handle regular json errors', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);
    $response = new Response(
        401,
        ['Content-Type' => 'application/json'],
        json_encode(['error' => 'Unauthorized'])
    );

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->request($payload);
})->throws(ErrorException::class, 'Unauthorized');

test('request can throw resend errors', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);
    $response = new Response(422, ['content-type' => 'application/json'], json_encode([
        'statusCode' => 422,
        'name' => 'missing_required_field',
        'message' => 'Missing `to` field',
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->request($payload))->toThrow(function (ErrorException $exception) {
        expect($exception->getMessage())->toBe('Missing `to` field')
            ->and($exception->getErrorMessage())->toBe('Missing `to` field')
            ->and($exception->getErrorCode())->toBe(422)
            ->and($exception->getErrorType())->toBe('missing_required_field');
    });
});

test('request can throw json error', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);
    $response = new Response(422, ['content-type' => 'application/json'], 'err');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->request($payload);
})->throws(UnserializableResponse::class, 'Syntax error');

test('request can handle server errors', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);
    $response = new Response(422, ['content-type' => 'application/json'], json_encode([
        'error' => [
            'code' => 422,
            'type' => 'missing_required_field',
            'message' => 'Missing `to` field',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->request($payload))->toThrow(function (ErrorException $exception) {
        expect($exception->getMessage())->toBe('Missing `to` field')
            ->and($exception->getErrorMessage())->toBe('Missing `to` field')
            ->and($exception->getErrorCode())->toBe(422)
            ->and($exception->getErrorType())->toBe('missing_required_field');
    });
});

test('request can handle non json errors', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);
    $response = new Response(200, ['content-type' => 'text/html'], 'err');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->request($payload);
})->throws(UnserializableResponse::class, "Unexpected Content-Type 'text/html'. Response body: err");

test('request throws on empty JSON response body', function () {
    $payload = Payload::create('email', ['to' => 'test@resend.com']);
    $response = new Response(200, ['Content-Type' => 'application/json'], '');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->request($payload);
})->throws(UnserializableResponse::class, 'Empty');
