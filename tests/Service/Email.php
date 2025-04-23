<?php

use Resend\Email;

it('can get an email resource', function () {
    $client = mockClient('GET', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [], [], email());

    $result = $client->emails->get('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('can send an email with an idempotency key', function () {
    $client = mockClient('POST', 'emails', [
        'to' => 'test@resend.com',
    ], [
        'Idempotency-Key' => 'unique-key',
    ], email());

    $result = $client->emails->send(['to' => 'test@resend.com'], ['idempotency_key' => 'unique-key']);

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('can update a scheduled email', function () {
    $client = mockClient('PATCH', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [
        'scheduled_at' => '2024-08-05T11:52:01.858Z',
    ], [], ['object' => 'email', 'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794']);

    $result = $client->emails->update('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [
        'scheduled_at' => '2024-08-05T11:52:01.858Z',
    ]);

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('can cancel a scheduled email', function () {
    $client = mockClient('POST', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794/cancel', [], [], [
        'object' => 'email',
        'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
    ]);

    $result = $client->emails->cancel('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});
