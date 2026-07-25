<?php

use Resend\Domains\Claim;

it('can get a claim for a domain', function () {
    $client = mockClient('GET', 'domains/dacf4072-4119-4d88-932f-6c6126d3a9d1/claims', [], [], domainClaim());

    $result = $client->domains->claims->get('dacf4072-4119-4d88-932f-6c6126d3a9d1');

    expect($result)->toBeInstanceOf(Claim::class)
        ->id->toBe('dacf4072-4119-4d88-932f-6c6126d3a9d1');
});

it('can create a claim for a domain', function () {
    $client = mockClient('POST', 'domains/claims', [
        'name' => 'example.com',
    ], [], domainClaim());

    $result = $client->domains->claims->create([
        'name' => 'example.com',
    ]);

    expect($result)->toBeInstanceOf(Claim::class)
        ->id->toBe('dacf4072-4119-4d88-932f-6c6126d3a9d1');
});

it('can trigger DNS verification for a domain claim', function () {
    $client = mockClient('POST', 'domains/dacf4072-4119-4d88-932f-6c6126d3a9d1/claims/verify', [], [], domainClaim());

    $result = $client->domains->claims->verify('dacf4072-4119-4d88-932f-6c6126d3a9d1');

    expect($result)->toBeInstanceOf(Claim::class)
        ->id->toBe('dacf4072-4119-4d88-932f-6c6126d3a9d1');
});
