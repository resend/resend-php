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
