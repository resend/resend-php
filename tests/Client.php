<?php

use Resend\Service\ApiKey;

test('service is created when required through property', function () {
    $resend = Resend::client('foo');

    expect($resend->apiKeys)
        ->toBeInstanceOf(ApiKey::class);
});

test('sevice is created when required through method', function () {
    $resend = Resend::client('foo');

    expect($resend->apiKeys())
        ->toBeInstanceOf(ApiKey::class);
});
