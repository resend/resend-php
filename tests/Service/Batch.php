<?php

use Resend\Collection;

it('can send a batch of emails', function () {
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

it('can send a batch of emails with an idempotency key', function () {
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

    $client = mockClient('POST', 'emails/batch', $payload, ['Idempotency-Key' => 'unique-key'], batch());

    $result = $client->batch->send($payload, ['idempotency_key' => 'unique-key']);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can send a batch of emails with scheduled_at, tags, and attachments', function () {
    $payload = [
        [
            'to' => 'test@resend.com',
            'from' => 'noreply@resend.com',
            'subject' => 'Acme',
            'text' => 'it works!',
            'scheduled_at' => '2024-08-05T11:52:01.858Z',
            'tags' => [
                [
                    'name' => 'category',
                    'value' => 'confirm_email',
                ],
            ],
            'attachments' => [
                [
                    'filename' => 'sample.txt',
                    'content' => 'dGVzdA==',
                ],
            ],
        ],
    ];

    $client = mockClient('POST', 'emails/batch', $payload, [], batch());

    $result = $client->batch->send($payload);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can send a batch of emails with batch validation', function () {
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

    $client = mockClient('POST', 'emails/batch', $payload, ['x-batch-validation' => 'permissive'], batch());

    $result = $client->batch->send($payload, ['batch_validation' => 'permissive']);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
