<?php

use Resend\ValueObjects\Transporter\BaseUri;

it('can be created from a string', function () {
    $baseUri = BaseUri::from('api.resend.com');

    expect($baseUri->toString())->toBe('https://api.resend.com/');
});

it('can be created with a protocol', function () {
    $baseUri = BaseUri::from('http://api.resend.test');

    expect($baseUri->toString())->toBe('http://api.resend.test/');
});

it('can be created with a trailing slash', function () {
    $baseUri = BaseUri::from('https://eu-api.resend.com/');

    expect($baseUri->toString())->toBe('https://eu-api.resend.com/');
});
