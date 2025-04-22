<?php

use Resend\Enums\Transporter\ContentType;
use Resend\ValueObjects\ApiKey;
use Resend\ValueObjects\Transporter\Headers;

it('can be created from an API key', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'));

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
    ]);
});

it('can have content/type', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'))
                      ->withContentType(ContentType::JSON);

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'application/json',
    ]);
});

it('can have a idempotency key', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'))
        ->withIdempotencyKey('unique-key');

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Idempotency-Key' => 'unique-key',
    ]);
});
