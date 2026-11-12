<?php

use Resend\Client;
use Resend\Contracts\Transporter;
use Resend\Domain;

it('can enable Forge for a domain', function () {
    $client = mockClient('POST', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206/forge', [
        'return_path' => 'send',
    ], [], domain());

    $result = $client->domains->forge->enable('d91cd9bd-1176-453e-8fc1-35364d380206', [
        'return_path' => 'send',
    ]);

    expect($result)->toBeInstanceOf(Domain::class)
        ->id->toBe('d91cd9bd-1176-453e-8fc1-35364d380206');
});

it('can enable Forge without a return path', function () {
    $client = mockClient('POST', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206/forge', [], [], domain());

    $result = $client->domains->forge->enable('d91cd9bd-1176-453e-8fc1-35364d380206');

    expect($result)->toBeInstanceOf(Domain::class)
        ->id->toBe('d91cd9bd-1176-453e-8fc1-35364d380206');
});

it('can not enable Forge with an empty domain ID', function () {
    /** @var Mockery\MockInterface|Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);
    $client = new Client($transporter);

    $client->domains->forge->enable('');
})->throws(InvalidArgumentException::class, 'The domain ID must be a non-empty string.');
