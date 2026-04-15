<?php

use Resend\Collection;
use Resend\Domain;

it('can get a domain resource', function () {
    $client = mockClient('GET', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206', [], [], domain());

    $result = $client->domains->get('d91cd9bd-1176-453e-8fc1-35364d380206');

    expect($result)->toBeInstanceOf(Domain::class)
        ->id->toBe('d91cd9bd-1176-453e-8fc1-35364d380206');
});

it('exposes the TrackingCAA record when present', function () {
    $client = mockClient('GET', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206', [], [], domain());

    $result = $client->domains->get('d91cd9bd-1176-453e-8fc1-35364d380206');

    $caaRecords = array_values(array_filter(
        $result->records,
        fn (array $record) => $record['record'] === 'TrackingCAA',
    ));

    expect($caaRecords)->toHaveCount(1)
        ->and($caaRecords[0]['record'])->toBe('TrackingCAA')
        ->and($caaRecords[0]['type'])->toBe('CAA')
        ->and($caaRecords[0]['value'])->toBe('0 issue "amazon.com"')
        ->and($caaRecords[0]['ttl'])->toBe('Auto')
        ->and($caaRecords[0]['status'])->toBe('verified');
});

it('can create a domain resource', function () {
    $client = mockClient('POST', 'domains', [
        'name' => 'resend.dev',
    ], [], domain());

    $result = $client->domains->create([
        'name' => 'resend.dev',
    ]);

    expect($result)->toBeInstanceOf(Domain::class)
        ->id->toBe('d91cd9bd-1176-453e-8fc1-35364d380206');
});

it('can get a list of domain resources', function () {
    $client = mockClient('GET', 'domains', [], [], domains());

    $result = $client->domains->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update a domain resource', function () {
    $client = mockClient('PATCH', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206', [
        'open_tracking' => false,
        'click_tracking' => true,
    ], [], domain());

    $result = $client->domains->update('d91cd9bd-1176-453e-8fc1-35364d380206', [
        'open_tracking' => false,
        'click_tracking' => true,
    ]);

    expect($result)->toBeInstanceOf(Domain::class);
});

it('can remove a domain resource', function () {
    $client = mockClient('DELETE', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206', [], [], domain());

    $result = $client->domains->remove('d91cd9bd-1176-453e-8fc1-35364d380206');

    expect($result)->toBeInstanceOf(Domain::class);
});

it('can verify a domain resource', function () {
    $client = mockClient('POST', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206/verify', [], [], [
        'object' => 'domain',
        'id' => 'd91cd9bd-1176-453e-8fc1-35364d380206',
    ]);

    $result = $client->domains->verify('d91cd9bd-1176-453e-8fc1-35364d380206');

    expect($result)->toBeInstanceOf(Domain::class)
        ->id->toBe('d91cd9bd-1176-453e-8fc1-35364d380206');
});
