<?php

use Resend\Collection;
use Resend\Inbox;
use Resend\Service\Inboxes\Agent;
use Resend\Service\Inboxes\Draft;
use Resend\Service\Inboxes\Label;
use Resend\Service\Inboxes\Thread;
use Resend\Service\Inboxes\Threads\Email;

it('can create an inbox resource', function () {
    $client = mockClient('POST', 'inboxes', [
        'email_address' => 'support@acme.com',
        'name' => 'Support',
        'from_name' => 'Acme Support',
        'forwarding' => true,
    ], [], [
        'object' => 'inbox',
        'id' => 'b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c',
    ]);

    $result = $client->inboxes->create([
        'email_address' => 'support@acme.com',
        'name' => 'Support',
        'from_name' => 'Acme Support',
        'forwarding' => true,
    ]);

    expect($result)->toBeInstanceOf(Inbox::class)
        ->object->toBe('inbox')
        ->id->toBe('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c');
});

it('can get a list of inbox resources', function () {
    $client = mockClient('GET', 'inboxes?limit=10&after=b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [], [], inboxes());

    $result = $client->inboxes->list([
        'limit' => 10,
        'after' => 'b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c',
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->has_more->toBeFalse()
        ->data->toHaveCount(1)
        ->and($result->data[0])->toBeInstanceOf(Inbox::class)
        ->email_address->toBe('support@acme.com')
        ->last_received->toBeNull()
        ->domain_id->toBeNull();
});

it('can get an inbox resource by ID', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [], [], inbox());

    $result = $client->inboxes->get('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c');

    expect($result)->toBeInstanceOf(Inbox::class)
        ->id->toBe('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c')
        ->receiving_address->toBeNull()
        ->drafts->toBe(1);
});

it('can get an inbox resource by email address', function () {
    $client = mockClient('GET', 'inboxes/support%2Bteam%40acme.com', [], [], inbox());

    $result = $client->inboxes->get('support+team@acme.com');

    expect($result)->toBeInstanceOf(Inbox::class)
        ->email_address->toBe('support@acme.com');
});

it('throws when getting an inbox with an empty ID', function () {
    $client = Resend::client('foo');

    $client->inboxes->get('');
})->throws(InvalidArgumentException::class, 'The inboxes ID must be a non-empty string.');

it('can update an inbox resource', function () {
    $client = mockClient('PATCH', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [
        'name' => 'Customer Support',
        'from_name' => '',
    ], [], [
        'object' => 'inbox',
        'id' => 'b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c',
    ]);

    $result = $client->inboxes->update('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [
        'name' => 'Customer Support',
        'from_name' => '',
    ]);

    expect($result)->toBeInstanceOf(Inbox::class)
        ->id->toBe('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c');
});

it('can remove an inbox resource', function () {
    $client = mockClient('DELETE', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [], [], [
        'object' => 'inbox',
        'id' => 'b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c',
        'deleted' => true,
    ]);

    $result = $client->inboxes->remove('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c');

    expect($result)->toBeInstanceOf(Inbox::class)
        ->deleted->toBeTrue();
});

it('exposes the nested inbox services', function () {
    $client = Resend::client('foo');

    expect($client->inboxes->agent)->toBeInstanceOf(Agent::class)
        ->and($client->inboxes->drafts)->toBeInstanceOf(Draft::class)
        ->and($client->inboxes->labels)->toBeInstanceOf(Label::class)
        ->and($client->inboxes->threads)->toBeInstanceOf(Thread::class)
        ->and($client->inboxes->threads->emails)->toBeInstanceOf(Email::class);
});
