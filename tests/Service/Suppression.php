<?php

use Resend\Client;
use Resend\Collection;
use Resend\Contracts\Transporter;
use Resend\Suppression;

it('can get a suppression by id', function () {
    $client = mockClient('GET', 'suppressions/e169aa45-1ecf-4183-9955-b1499d5701d3', [], [], suppression());

    $result = $client->suppressions->get('e169aa45-1ecf-4183-9955-b1499d5701d3');

    expect($result)->toBeInstanceOf(Suppression::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can get a suppression by email', function () {
    $client = mockClient('GET', 'suppressions/steve.wozniak@example.com', [], [], suppression());

    $result = $client->suppressions->get('steve.wozniak@example.com');

    expect($result)->toBeInstanceOf(Suppression::class)
        ->email->toBe('steve.wozniak@example.com');
});

it('can add an email to the suppression list', function () {
    $client = mockClient('POST', 'suppressions', [
        'email' => 'steve.wozniak@example.com',
    ], [], suppression());

    $result = $client->suppressions->add([
        'email' => 'steve.wozniak@example.com',
    ]);

    expect($result)->toBeInstanceOf(Suppression::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can get a list of suppressions', function () {
    $client = mockClient('GET', 'suppressions', [], [], suppressions());

    $result = $client->suppressions->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can get a list of suppressions filtered by origin', function () {
    $client = mockClient('GET', 'suppressions?origin=manual', [], [], suppressions());

    $result = $client->suppressions->list(['origin' => 'manual']);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can remove a suppression by id', function () {
    $client = mockClient('DELETE', 'suppressions/e169aa45-1ecf-4183-9955-b1499d5701d3', [], [], suppression());

    $result = $client->suppressions->remove('e169aa45-1ecf-4183-9955-b1499d5701d3');

    expect($result)->toBeInstanceOf(Suppression::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can remove a suppression by email', function () {
    $client = mockClient('DELETE', 'suppressions/steve.wozniak@example.com', [], [], suppression());

    $result = $client->suppressions->remove('steve.wozniak@example.com');

    expect($result)->toBeInstanceOf(Suppression::class)
        ->email->toBe('steve.wozniak@example.com');
});

it('can add a batch of emails to a suppression list', function () {
    $client = mockClient('POST', 'suppressions/batch/add', [
        'emails' => ['steve.wozniak@example.com', 'susan.kare@example.com'],
    ], [], suppressions());

    $result = $client->suppressions->batch->add([
        'emails' => ['steve.wozniak@example.com', 'susan.kare@example.com'],
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can remove a batch of emails from a suppression list', function () {
    $client = mockClient('POST', 'suppressions/batch/remove', [
        'emails' => ['steve.wozniak@example.com', 'susan.kare@example.com'],
    ], [], suppressions());

    $result = $client->suppressions->batch->remove([
        'emails' => ['steve.wozniak@example.com', 'susan.kare@example.com'],
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can remove a batch of ids from a suppression list', function () {
    $client = mockClient('POST', 'suppressions/batch/remove', [
        'ids' => ['e169aa45-1ecf-4183-9955-b1499d5701d3'],
    ], [], suppressions());

    $result = $client->suppressions->batch->remove([
        'ids' => ['e169aa45-1ecf-4183-9955-b1499d5701d3'],
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can not remove a batch of emails and ids from a suppression list', function () {
    /** @var Mockery\MockInterface|Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);
    $client = new Client($transporter);

    $client->suppressions->batch->remove([
        'emails' => ['steve.wozniak@example.com', 'susan.kare@example.com'],
        'ids' => ['e169aa45-1ecf-4183-9955-b1499d5701d3'],
    ]);
})->throws(InvalidArgumentException::class, "Provide either 'emails' or 'ids', but not both.");
