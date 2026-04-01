<?php

use Resend\Collection;
use Resend\Domains\TrackingDomain;

it('can get a tracking domain resource', function () {
    $client = mockClient('GET', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206/tracking-domains/a1b2c3d4-e5f6-7890-abcd-ef1234567890', [], [], trackingDomain());

    $result = $client->domains->trackingDomains->get('d91cd9bd-1176-453e-8fc1-35364d380206', 'a1b2c3d4-e5f6-7890-abcd-ef1234567890');

    expect($result)->toBeInstanceOf(TrackingDomain::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can create a tracking domain resource', function () {
    $client = mockClient('POST', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206/tracking-domains', [
        'subdomain' => 'links',
    ], [], trackingDomain());

    $result = $client->domains->trackingDomains->create('d91cd9bd-1176-453e-8fc1-35364d380206', ['subdomain' => 'links']);

    expect($result)->toBeInstanceOf(TrackingDomain::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can get a list of tracking domain resources', function () {
    $client = mockClient('GET', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206/tracking-domains', [], [], trackingDomains());

    $result = $client->domains->trackingDomains->list('d91cd9bd-1176-453e-8fc1-35364d380206');

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can remove a tracking domain resource', function () {
    $client = mockClient('DELETE', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206/tracking-domains/a1b2c3d4-e5f6-7890-abcd-ef1234567890', [], [], trackingDomain());

    $result = $client->domains->trackingDomains->remove('d91cd9bd-1176-453e-8fc1-35364d380206', 'a1b2c3d4-e5f6-7890-abcd-ef1234567890');

    expect($result)->toBeInstanceOf(TrackingDomain::class);
});

it('can verify a tracking domain resource', function () {
    $client = mockClient('POST', 'domains/d91cd9bd-1176-453e-8fc1-35364d380206/tracking-domains/a1b2c3d4-e5f6-7890-abcd-ef1234567890/verify', [], [], trackingDomain());

    $result = $client->domains->trackingDomains->verify('d91cd9bd-1176-453e-8fc1-35364d380206', 'a1b2c3d4-e5f6-7890-abcd-ef1234567890');

    expect($result)->toBeInstanceOf(TrackingDomain::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});
