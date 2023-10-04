<?php

use Resend\Collection;

it('can send a  batch of emails', function () {
    $client = mockClient('POST', 'emails/batch', [
        [
            'to' => 'test@resend.com',
        ],
        [
            'to' => 'test@resend.com',
        ],
    ], batch());

    $result = $client->batch->send([
        [
            'to' => 'test@resend.com',
        ],
        [
            'to' => 'test@resend.com',
        ],
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
