<?php

use Resend\Client;

it('can create a client', function () {
    $resend = Resend::client('foo');

    expect($resend)->toBeInstanceOf(Client::class);
});

it('can create a client when the RESEND_BASE_URL environment variable is set', function () {
    putenv('RESEND_BASE_URL=https://eu-api.resend.com/');

    $resend = Resend::client('foo');

    expect($resend)->toBeInstanceOf(Client::class);
});
