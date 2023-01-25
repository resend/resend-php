<?php

use Resend\Client;

it('can create a client', function () {
    $resend = Resend::client('foo');

    expect($resend)->toBeInstanceOf(Client::class);
});
