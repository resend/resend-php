<?php

use Resend\Collection;
use Resend\Emails\Receiving;

it('can get an inbound email resource', function () {
    $client = mockClient('GET', 'emails/receiving/4ef9a417-02e9-4d39-ad75-9611e0fcc33c', [], [], inboundEmail());

    $result = $client->emails->receiving->get('4ef9a417-02e9-4d39-ad75-9611e0fcc33c');

    expect($result)->toBeInstanceOf(Receiving::class)
        ->id->toBe('4ef9a417-02e9-4d39-ad75-9611e0fcc33c')
        ->received_for->toBe(['forwarded@example.com']);
});

it('can get a list of inbound email resources', function () {
    $client = mockClient('GET', 'emails/receiving', [], [], inboundEmails());

    $result = $client->emails->receiving->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can filter the list of inbound emails by recipient and date', function () {
    $client = mockClient('GET', 'emails/receiving?to=support%40acme.com%2Cbilling%40acme.com&start_date=2026-11-01&end_date=2026-11-15T12%3A00%3A00Z&limit=25&after=cursor123', [], [], inboundEmails());

    $result = $client->emails->receiving->list([
        'to' => ['support@acme.com', 'billing@acme.com'],
        'start_date' => '2026-11-01',
        'end_date' => '2026-11-15T12:00:00Z',
        'limit' => 25,
        'after' => 'cursor123',
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('omits inbound email filters that are not set', function () {
    $client = mockClient('GET', 'emails/receiving?to=support%40acme.com&before=cursor123', [], [], inboundEmails());

    $result = $client->emails->receiving->list([
        'to' => ['support@acme.com'],
        'before' => 'cursor123',
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
