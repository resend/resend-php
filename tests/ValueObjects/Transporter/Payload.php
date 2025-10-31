<?php

use Resend\Enums\Transporter\ContentType;
use Resend\ValueObjects\ApiKey;
use Resend\ValueObjects\Transporter\BaseUri;
use Resend\ValueObjects\Transporter\Headers;
use Resend\ValueObjects\Transporter\Payload;

it('has a method', function () {
    $payload = Payload::create('email', []);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getMethod())->toBe('POST');
});

it('has a body when making a POST request', function () {
    $payload = Payload::create('email', [
        'to' => 'test@resend.com',
    ]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getBody()->getContents())->toBe(json_encode([
        'to' => 'test@resend.com',
    ]));
});

it('does not have a body when making a GET request', function () {
    $payload = Payload::list('api-keys');

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getBody()->getContents())->toBe('');
});

it('can create pagination requests', function () {
    $payload = Payload::list('emails', ['limit' => 2, 'after' => 'cursor123', 'before' => 'cursor789']);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    expect((string) $payload->toRequest($baseUri, $headers)->getUri())->toBe('https://api.resend.com/emails?limit=2&after=cursor123&before=cursor789');
});

it('can create pagination requests with a single option', function () {
    $payload = Payload::list('emails', ['limit' => 2]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    expect((string) $payload->toRequest($baseUri, $headers)->getUri())->toBe('https://api.resend.com/emails?limit=2');
});

it('does not have a body when making a DELETE request', function () {
    $payload = Payload::delete('api-keys', 're_123456');

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getBody()->getContents())->toBe('')
        ->and($request->getUri()->getPath())->toBe('/api-keys/re_123456');
});

it('can send verify requests with empty body', function () {
    $payload = Payload::verify('domains', 're_123456');

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getBody()->getContents())->toBe('{}')
        ->and($request->getUri()->getPath())->toBe('/domains/re_123456/verify');
});

it('can send publish requests with empty body', function () {
    $payload = Payload::publish('templates', 're_123456');

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getBody()->getContents())->toBe('{}')
        ->and($request->getUri()->getPath())->toBe('/templates/re_123456/publish');
});

it('can send duplicate requests with empty body', function () {
    $payload = Payload::duplicate('templates', 're_123456');

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getBody()->getContents())->toBe('{}')
        ->and($request->getUri()->getPath())->toBe('/templates/re_123456/duplicate');
});

it('can convert an empty array body to a JSON object', function () {
    $payload = Payload::create('domains', []);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getBody()->getContents())->toBe('{}')
        ->and($request->getUri()->getPath())->toBe('/domains');
});

it('throws an error when using an empty string to get a single resource', function () {
    Payload::get('domains', '');
})->throws(InvalidArgumentException::class, 'The domains ID must be a non-empty string.');
