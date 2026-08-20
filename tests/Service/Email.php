<?php

use Resend\Client;
use Resend\Collection;
use Resend\Contracts\Transporter;
use Resend\Email;
use Resend\Exceptions\ErrorException;

it('can get an email resource', function () {
    $client = mockClient('GET', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [], [], email());

    $result = $client->emails->get('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->message_id->toBe('<111-222-333@email.example.com>');
});

it('can send an email', function () {
    $client = mockClient('POST', 'emails', [
        'to' => 'test@resend.com',
    ], [], email());

    $result = $client->emails->send([
        'to' => 'test@resend.com',
    ]);

    expect($result)
        ->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->from->toBe('onboarding@resend.dev')
        ->to->toBe('user@gmail.com');
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

it('can create a shareable link for an email with the default expiration', function () {
    $client = mockClient('POST', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794/share', [], [], sharedEmail());

    $result = $client->emails->share('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->url->toBe('https://resend.com/share/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('can create a shareable link for an email with a custom expiration', function () {
    $client = mockClient('POST', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794/share', [
        'expires_in' => '10m',
    ], [], sharedEmail());

    $result = $client->emails->share('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [
        'expires_in' => '10m',
    ]);

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->url->toBe('https://resend.com/share/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('throws when expires_in exceeds the maximum allowed duration', function () {
    /** @var Mockery\MockInterface|Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);
    $client = new Client($transporter);

    $transporter
        ->shouldReceive('request')
        ->once()
        ->andThrow(new ErrorException([
            'statusCode' => 422,
            'name' => 'validation_error',
            'message' => 'expires_in must not exceed 48h',
        ]));

    $client->emails->share('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [
        'expires_in' => '72h',
    ]);
})->throws(ErrorException::class, 'expires_in must not exceed 48h');

it('throws when the email to share does not exist', function () {
    /** @var Mockery\MockInterface|Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);
    $client = new Client($transporter);

    $transporter
        ->shouldReceive('request')
        ->once()
        ->andThrow(new ErrorException([
            'statusCode' => 404,
            'name' => 'not_found',
            'message' => 'Email not found',
        ]));

    $client->emails->share('00000000-0000-0000-0000-000000000000');
})->throws(ErrorException::class, 'Email not found');

it('can get a list of email resources', function () {
    $client = mockClient('GET', 'emails', [], [], emails());

    $result = $client->emails->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can get a list of email resources with a limit', function () {
    $client = mockClient('GET', 'emails?limit=2', [], [], emails());

    $result = $client->emails->list(['limit' => 2]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can get a list of email resources before cursor', function () {
    $client = mockClient('GET', 'emails?before=cursor123', [], [], emails());

    $result = $client->emails->list(['before' => 'cursor123']);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can get a list of email resources after cursor', function () {
    $client = mockClient('GET', 'emails?after=cursor123', [], [], emails());

    $result = $client->emails->list(['after' => 'cursor123']);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
