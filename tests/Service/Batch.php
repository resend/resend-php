<?php

use Resend\Collection;

it('can send a  batch of emails', function () {
    $payload = [
        [
            'to' => 'test@resend.com',
            'from' => 'noreply@resend.com',
            'subject' => 'Acme',
            'text' => 'it works!',
        ],
        [
            'to' => 'test@resend.com',
            'from' => 'noreply@resend.com',
            'subject' => 'Acme',
            'text' => 'it works!',
        ],
    ];

    $client = mockClient('POST', 'emails/batch', $payload, [], batch());

    $result = $client->batch->send($payload);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
