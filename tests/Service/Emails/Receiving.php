<?php

use Resend\Collection;
use Resend\Emails\Receiving;

it('can get an inbound email resource', function () {
    $client = mockClient('GET', 'emails/receiving/4ef9a417-02e9-4d39-ad75-9611e0fcc33c', [], [], inboundEmail());

    $result = $client->emails->receiving->get('4ef9a417-02e9-4d39-ad75-9611e0fcc33c');

    expect($result)->toBeInstanceOf(Receiving::class)
        ->id->toBe('4ef9a417-02e9-4d39-ad75-9611e0fcc33c');
});

it('can get a list of inbound email resources', function () {
    $client = mockClient('GET', 'emails/receiving', [], [], inboundEmails());

    $result = $client->emails->receiving->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
