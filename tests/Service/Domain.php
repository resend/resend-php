<?php

use Resend\Collection;
use Resend\Domain;

it('can get a domain resource', function () {
    $client = mockClient('GET', 'domains/4dd369bc-aa82-4ff3-97de-514ae3000ee0', [], domain());

    $result = $client->domains->get('4dd369bc-aa82-4ff3-97de-514ae3000ee0');

    expect($result)->toBeInstanceOf(Domain::class)
        ->id->toBe('4dd369bc-aa82-4ff3-97de-514ae3000ee0');
});

it('can create a domain resource', function () {
    $client = mockClient('POST', 'domains', [
        'name' => 'resend.dev',
    ], domain());

    $result = $client->domains->create([
        'name' => 'resend.dev',
    ]);

    expect($result)->toBeInstanceOf(Domain::class)
        ->id->toBe('4dd369bc-aa82-4ff3-97de-514ae3000ee0');
});

it('can get a list of domain resources', function () {
    $client = mockClient('GET', 'domains', [], domains());

    $result = $client->domains->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update a domain resource', function () {
    $client = mockClient('PATCH', 'domains/4dd369bc-aa82-4ff3-97de-514ae3000ee0', [], domain());

    $result = $client->domains->update('4dd369bc-aa82-4ff3-97de-514ae3000ee0', [
        'open_tracking' => false,
        'click_tracking' => true,
    ]);

    expect($result)->toBeInstanceOf(Domain::class);
});

it('can remove a domain resource', function () {
    $client = mockClient('DELETE', 'domains/4dd369bc-aa82-4ff3-97de-514ae3000ee0', [], domain());

    $result = $client->domains->remove('4dd369bc-aa82-4ff3-97de-514ae3000ee0');

    expect($result)->toBeInstanceOf(Domain::class);
});

it('can verify a domain resource', function () {
    $client = mockClient('POST', 'domains/re_1234567/verify', [], domain());

    $result = $client->domains->verify('re_1234567');

    expect($result)->toBeInstanceOf(Domain::class)
        ->id->toBe('4dd369bc-aa82-4ff3-97de-514ae3000ee0');
});
